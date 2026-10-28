<?php

namespace App\Console\Commands;

use App\Models\Band;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ScrapeBandImages extends Command
{
    protected $signature = 'app:scrape-band-images {--band= : Single band ID} {--force : Overwrite existing photos}';

    protected $description = 'Scrape band images from Bandcamp using band name and members';

    public function handle(): int
    {
        $bands = $this->option('band')
            ? Band::with('artists')->where('id', $this->option('band'))->get()
            : Band::with('artists')->whereNull('photo')->orderBy('name')->get();

        if (! $this->option('force')) {
            $bands = $bands->filter(fn ($b) => ! $b->photo);
        }

        if ($bands->isEmpty()) {
            $this->info('No bands to scrape.');

            return self::SUCCESS;
        }

        $this->info("Searching Bandcamp for {$bands->count()} bands...\n");

        $bar = $this->output->createProgressBar($bands->count());
        $bar->start();

        $found = 0;
        $notFound = [];

        foreach ($bands as $band) {
            sleep(2); // respect Bandcamp rate limits

            $imageUrl = $this->findOnBandcamp($band);

            if ($imageUrl) {
                $saved = $this->downloadAndSave($band, $imageUrl);
                if ($saved) {
                    $found++;
                } else {
                    $notFound[] = "⚠️ {$band->name} → download failed";
                }
            } else {
                $notFound[] = "❌ {$band->name}";
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Done: {$found} found, " . count($notFound) . " not found.\n");

        if (! empty($notFound)) {
            $this->warn('Not found:');
            foreach ($notFound as $n) {
                $this->line("  {$n}");
            }
        }

        return self::SUCCESS;
    }

    private function findOnBandcamp(Band $band): ?string
    {
        // Strategy 1: Direct URL guess — bandname.bandcamp.com
        $imageUrl = $this->scrapeDirectUrl($band);
        if ($imageUrl) {
            return $imageUrl;
        }

        // Strategy 2: Bandcamp search by band name
        $imageUrl = $this->searchBandcamp($band->name);
        if ($imageUrl) {
            return $imageUrl;
        }

        // Strategy 3: Bandcamp search by band name + first member name
        $firstMember = $band->artists->first();
        if ($firstMember) {
            sleep(1);
            $query = "{$band->name} {$firstMember->name}";
            $imageUrl = $this->searchBandcamp($query);
            if ($imageUrl) {
                return $imageUrl;
            }
        }

        // Strategy 4: Clean up band name and try direct URL again (lowercase, no spaces)
        $slug = Str::slug(preg_replace('/[^a-zA-Z0-9\s]/', '', $band->name));
        sleep(1);
        $imageUrl = $this->scrapeUrl("https://{$slug}.bandcamp.com");
        if ($imageUrl) {
            return $imageUrl;
        }

        // Strategy 5: Try with hyphens instead of removing special chars
        $slug2 = strtolower(str_replace(' ', '', preg_replace('/[^a-zA-Z0-9\s]/', '', $band->name)));
        sleep(1);
        $imageUrl = $this->scrapeUrl("https://{$slug2}.bandcamp.com");
        if ($imageUrl) {
            return $imageUrl;
        }

        return null;
    }

    private function scrapeDirectUrl(Band $band): ?string
    {
        $slug = Str::slug($band->name);

        return $this->scrapeUrl("https://{$slug}.bandcamp.com");
    }

    private function scrapeUrl(string $url): ?string
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml',
            ])
                ->timeout(15)
                ->get($url);

            if (! $response->successful()) {
                return null;
            }

            $html = $response->body();

            // Skip if this is a Bandcamp "not found" or fan page, not an artist page
            if (str_contains($html, 'page not found') || str_contains($html, 'custom_domain_unavailable')) {
                return null;
            }

            // Extract the band image from Bandcamp's artist page
            // Bandcamp artist pages have the image in various locations:
            // 1. <img class="band-photo"> in the bio section
            // 2. <div id="bio-pic-container"> or similar
            // 3. Open Graph meta tag

            // Try Open Graph image first (most reliable)
            if (preg_match('/<meta\s+property="og:image"\s+content="([^"]+)"/i', $html, $m)) {
                $img = $m[1];
                // Skip Bandcamp's default placeholder
                if (! str_contains($img, 'bcbits') || str_contains($img, 'default')) {
                    // Some og:image are placeholders, check URL pattern
                    if (str_contains($img, 'f4.bcbits.com') || str_contains($img, 'bandcamp.com/img/')) {
                        return $img;
                    }
                }
            }

            // Try band photo specific selectors
            if (preg_match('/<img[^>]+class="[^"]*band-photo[^"]*"[^>]+src="([^"]+)"/i', $html, $m)) {
                return $m[1];
            }

            // Try bio-pic-container
            if (preg_match('/id="bio-pic-container"[^>]*>.*?<img[^>]+src="([^"]+)"/is', $html, $m)) {
                return $m[1];
            }

            // Try any img inside bio section with bcbits in URL
            if (preg_match('/src="(https:\/\/f4\.bcbits\.com\/[^"]+)"/i', $html, $m)) {
                return $m[1];
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function searchBandcamp(string $query): ?string
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml',
            ])
                ->timeout(15)
                ->get('https://bandcamp.com/search', [
                    'q' => $query,
                    'item_type' => 'b', // bands only
                ]);

            if (! $response->successful()) {
                return null;
            }

            $html = $response->body();

            // Extract the first band result image
            // Bandcamp search results have images in src attributes
            if (preg_match('/<img[^>]+src="(https:\/\/f4\.bcbits\.com\/img\/[^"]+)"/i', $html, $m)) {
                return $m[1];
            }

            // Try extracting any bcbits image
            if (preg_match('/src="(https:\/\/f4\.bcbits\.com\/[^"]+)"/i', $html, $m)) {
                return $m[1];
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function downloadAndSave(Band $band, string $url): ?string
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (compatible; LISTA-Bot/1.0)',
                'Referer' => 'https://bandcamp.com/',
            ])
                ->timeout(30)
                ->get($url);

            if (! $response->successful()) {
                return null;
            }

            $body = $response->body();
            if (strlen($body) < 2048) {
                return null;
            }

            $ext = 'jpg';
            $contentType = $response->header('Content-Type');
            if ($contentType) {
                if (str_contains($contentType, 'png')) {
                    $ext = 'png';
                }
                if (str_contains($contentType, 'webp')) {
                    $ext = 'webp';
                }
            }

            $filename = 'bands/' . Str::slug($band->name) . '.jpg';
            $disk = Storage::disk('public');

            if (! $disk->exists('bands')) {
                $disk->makeDirectory('bands');
            }

            $disk->put($filename, $body);

            $band->update(['photo' => $filename]);

            return $filename;
        } catch (\Exception $e) {
            return null;
        }
    }
}
