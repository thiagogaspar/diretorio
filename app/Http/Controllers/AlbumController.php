<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use App\Values\SeoData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function index(Request $request): View
    {
        $query = Album::with('band.genres');

        if ($request->filled('band')) {
            $query->whereHas('band', fn ($q) => $q->where('slug', $request->band));
        }
        if ($request->filled('year')) {
            $query->where('release_year', $request->year);
        }
        if ($request->filled('genre')) {
            $query->whereHas('band.genres', fn ($q) => $q->where('slug', $request->genre));
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $albums = $query->orderBy('release_year', 'desc')->paginate(24);
        $genres = Genre::orderBy('name')->pluck('name', 'slug')->all();
        $years = Album::whereNotNull('release_year')
            ->select('release_year')->distinct()
            ->orderBy('release_year', 'desc')
            ->pluck('release_year')
            ->all();

        return view('albums.index', compact('albums', 'genres', 'years'));
    }

    public function show(string $slug): View
    {
        $album = Album::whereSlug($slug)
            ->with(['band.genres', 'band.label'])
            ->firstOrFail();

        $seo = new SeoData(
            title: $album->title.' — '.$album->band->name,
            description: $album->description ? Str::limit(strip_tags($album->description), 160) : $album->title.' by '.$album->band->name,
            type: 'music.album',
            image: $album->cover_art ? img_url($album->cover_art) : null,
            canonical: route('albums.show', $album),
            schema: json_encode([
                '@context' => 'https://schema.org',
                '@graph' => [
                    ['@type' => 'BreadcrumbList', 'itemListElement' => [
                        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Albums', 'item' => route('albums.index')],
                        ['@type' => 'ListItem', 'position' => 3, 'name' => $album->title],
                    ]],
                    array_filter([
                        '@type' => 'MusicAlbum',
                        'name' => $album->title,
                        'url' => route('albums.show', $album),
                        'image' => $album->cover_art ? img_url($album->cover_art) : null,
                        'datePublished' => $album->release_year ? (string) $album->release_year : null,
                        'byArtist' => ['@type' => 'MusicGroup', 'name' => $album->band->name, 'url' => route('bands.show', $album->band)],
                        'genre' => $album->band->genres->pluck('name')->implode(', ') ?: null,
                        'track' => $album->tracklist ? collect($album->tracklist)->map(fn ($t, $i) => ['@type' => 'MusicRecording', 'position' => $i + 1, 'name' => is_array($t) ? ($t['title'] ?? $t[0] ?? '') : $t])->values()->toArray() : null,
                    ]),
                ],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        );

        return view('albums.show', compact('album', 'seo'));
    }
}
