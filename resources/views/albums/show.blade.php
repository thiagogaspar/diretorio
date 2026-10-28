@extends('layouts.app')

@section('head')
<x-seo-meta :seo="$seo" />
@if($album->cover_art)
<link rel="preload" href="{{ img_url($album->cover_art) }}" as="image" fetchpriority="high">
@endif
@endsection

@section('content')
<div class="max-w-6xl mx-auto px-4">
<!-- Hero — gradient bg -->
<section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-ink -mx-4 -mt-6 mb-10 overflow-hidden" style="min-height:30vh;">
    @if($album->cover_art)
    <img src="{{ img_url($album->cover_art) }}" alt="{{ $album->title }}" width="1920" height="480" class="absolute inset-0 w-full h-full object-cover opacity-20 mix-blend-overlay" fetchpriority="high" decoding="sync" sizes="100vw">
    @endif
    <div class="relative z-10 max-w-6xl mx-auto px-4 w-full py-14 sm:py-18">
        <div class="flex items-center gap-2 mb-3">
            <a href="{{ route('bands.show', $album->band) }}" class="badge badge-hero text-xs">{{ $album->band->name }}</a>
            @if($album->release_year)<span class="badge badge-hero">{{ $album->release_year }}</span>@endif
        </div>
        <h1 class="font-display text-3xl sm:text-5xl md:text-6xl font-black text-white leading-none tracking-tight">{{ $album->title }}</h1>
    </div>
</section>

<nav class="breadcrumb mb-8">
    <a href="{{ route('home') }}">{{ __('common.home_breadcrumb') }}</a><span>/</span>
    <a href="{{ route('albums.index') }}">{{ __('common.nav.albums') }}</a><span>/</span>
    <span>{{ $album->title }}</span>
</nav>

<div class="lg:flex lg:gap-10">
    <!-- Cover — left side -->
    <div class="lg:w-72 shrink-0">
        @if($album->cover_art)
        <img src="{{ img_url($album->cover_art) }}" alt="{{ $album->title }} cover" width="600" height="600" class="w-full aspect-square object-cover rounded-2xl shadow-lg border border-surface-200 dark:border-ink-700" fetchpriority="high">
        @else
        <div class="w-full aspect-square rounded-2xl shadow-sm bg-surface-100 dark:bg-ink-700 flex items-center justify-center text-surface-300 dark:text-ink-400 border border-surface-200 dark:border-ink-700">
            <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
        </div>
        @endif
    </div>

    <!-- Content — right side -->
    <div class="flex-1 min-w-0 mt-6 lg:mt-0">
        <h2 class="font-display text-3xl sm:text-4xl font-bold text-surface-900 dark:text-ink-200 leading-tight tracking-tight">{{ $album->title }}</h2>

        <div class="flex flex-wrap gap-2 mt-3">
            <a href="{{ route('bands.show', $album->band) }}" class="badge badge-brand text-sm py-1 px-3">{{ $album->band->name }}</a>
            @if($album->release_year)
            <span class="badge badge-surface">{{ $album->release_year }}</span>
            @endif
        </div>

        @if($album->description)
        <div class="prose max-w-none mt-6">{{ $album->description }}</div>
        @endif

        @if($album->tracklist)
        <x-section-header tag="h2" :count="count($album->tracklist)" class="mt-8">{{ __('common.albums.tracks') }}</x-section-header>
        <div class="rounded-xl overflow-hidden shadow-sm border border-surface-200 dark:border-ink-700 bg-white dark:bg-ink-800">
            <ol class="divide-y divide-surface-200 dark:divide-ink-700">
                @foreach($album->tracklist as $i => $track)
                <li class="flex items-center gap-3 px-4 py-2.5 hover:bg-surface-50 dark:hover:bg-ink-700/50 transition-colors">
                    <span class="font-display text-surface-400 text-xs font-bold w-6 text-right shrink-0">{{ $i + 1 }}.</span>
                    <span class="font-display text-sm font-bold text-surface-900 dark:text-ink-100">{{ is_array($track) ? ($track['title'] ?? $track[0] ?? '') : $track }}</span>
                </li>
                @endforeach
            </ol>
        </div>
        @endif
    </div>
</div>
</div>
@endsection
