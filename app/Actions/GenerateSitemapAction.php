<?php

namespace App\Actions;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Band;
use App\Models\Label;
use App\Models\Post;

class GenerateSitemapAction
{
    public function handle(): string
    {
        $urls = [];

        foreach (Band::where('is_active', true)->get(['slug', 'updated_at']) as $band) {
            $urls[] = $this->entry(route('bands.show', $band), $band->updated_at, '0.9', 'daily');
        }
        foreach (Artist::where('is_active', true)->get(['slug', 'updated_at']) as $artist) {
            $urls[] = $this->entry(route('artists.show', $artist), $artist->updated_at, '0.7', 'weekly');
        }
        foreach (Album::with('band')->get(['slug', 'updated_at']) as $album) {
            $urls[] = $this->entry(route('albums.show', $album), $album->updated_at, '0.6', 'weekly');
        }
        foreach (Label::get(['slug', 'updated_at']) as $label) {
            $urls[] = $this->entry(route('labels.show', $label), $label->updated_at, '0.5', 'monthly');
        }
        foreach (Post::where('is_published', true)->get(['slug', 'updated_at', 'published_at']) as $post) {
            $urls[] = $this->entry(route('blog.show', $post), $post->published_at ?? $post->updated_at, '0.6', 'monthly');
        }

        foreach ([
            ['route' => 'home', 'priority' => '1.0', 'freq' => 'daily'],
            ['route' => 'bands.index', 'priority' => '0.8', 'freq' => 'daily'],
            ['route' => 'artists.index', 'priority' => '0.7', 'freq' => 'weekly'],
            ['route' => 'albums.index', 'priority' => '0.6', 'freq' => 'weekly'],
            ['route' => 'labels.index', 'priority' => '0.5', 'freq' => 'weekly'],
            ['route' => 'genealogy', 'priority' => '0.4', 'freq' => 'weekly'],
            ['route' => 'blog.index', 'priority' => '0.6', 'freq' => 'weekly'],
        ] as $s) {
            $urls[] = $this->entry(route($s['route']), now(), $s['priority'], $s['freq']);
        }

        return view('sitemap', ['urls' => $urls])->render();
    }

    private function entry(string $loc, $lastmod, string $priority, string $changefreq): array
    {
        return ['loc' => $loc, 'lastmod' => $lastmod->toDateString(), 'priority' => $priority, 'changefreq' => $changefreq];
    }
}
