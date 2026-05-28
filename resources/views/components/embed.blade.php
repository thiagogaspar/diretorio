@php
$attrs = match(true) {
    str_contains($url, 'youtube') || str_contains($url, 'youtu.be') => ['src' => str_replace('watch?v=', 'embed/', $url) . '?rel=0', 'title' => $title ?? 'YouTube video'],
    str_contains($url, 'spotify') => ['src' => str_replace('open.spotify.com', 'open.spotify.com/embed', $url), 'title' => $title ?? 'Spotify player'],
    str_contains($url, 'bandcamp') => ['src' => $url, 'title' => $title ?? 'BandCamp player'],
    default => ['src' => $url, 'title' => $title ?? 'Embedded content'],
};
@endphp
<div class="embed-container">
    <iframe src="{{ $attrs['src'] }}" title="{{ $attrs['title'] }}" loading="lazy" allowfullscreen allow="encrypted-media *"></iframe>
</div>
