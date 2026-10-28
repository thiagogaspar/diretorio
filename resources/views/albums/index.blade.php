@extends('layouts.app')

@section('head')
@php
$seo = new \App\Values\SeoData(
    title: request('search') ? __('common.albums.seo_search', ['query' => e(request('search'))]) : __('common.albums.all'),
    description: __('common.albums.seo_description'),
    canonical: route('albums.index'),
);
@endphp
<x-seo-meta :seo="$seo" />
@endsection

@php $qs = http_build_query(request()->except('page')); @endphp

@section('content')
<div class="max-w-6xl mx-auto px-4">
<div class="flex items-center gap-4 mb-6">
    <h1 class="font-display text-xl sm:text-2xl font-bold text-surface-900 dark:text-ink-200">{{ __('common.nav.albums') }}</h1>
    <span class="h-px flex-1 bg-surface-200 dark:bg-ink-700"></span>
</div>

<form method="GET" class="p-4 bg-surface-50 dark:bg-ink-800/50 rounded-xl flex flex-col sm:flex-row flex-wrap gap-3 mb-6">
    <input name="search" value="{{ request('search') }}" placeholder="{{ __('common.albums.search') }}" aria-label="{{ __('common.albums.search_aria') }}" class="w-full sm:flex-1 sm:min-w-[200px] input">
    <select name="genre" aria-label="{{ __('common.albums.filter_genre_aria') }}" class="w-full sm:w-auto sm:max-w-[150px] select">
        <option value="">{{ __('common.albums.all_genres') }}</option>
        @foreach($genres as $slug => $name)
        <option value="{{ $slug }}" {{ request('genre') === $slug ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
    <select name="year" aria-label="{{ __('common.albums.filter_year_aria') }}" class="w-full sm:w-auto sm:max-w-[110px] select">
        <option value="">{{ __('common.albums.all_years') }}</option>
        @foreach($years as $y)
        <option value="{{ $y }}" {{ (string) request('year') === (string) $y ? 'selected' : '' }}>{{ $y }}</option>
        @endforeach
    </select>
    <button type="submit" class="w-full sm:w-auto btn bg-black text-white border-black hover:bg-surface-800 text-xs">{{ __('common.filter') }}</button>
</form>

<div class="flex items-center justify-between mb-4 font-display text-xs text-surface-500">
    <span class="font-bold uppercase tracking-wider">{{ trans_choice('common.albums.count', $albums->total()) }}</span>
</div>

<!-- Album grid — cards -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse($albums as $album)
    <a href="{{ route('albums.show', $album) }}" class="card overflow-hidden group">
        <div class="aspect-square overflow-hidden bg-surface-100 dark:bg-ink-900">
            @if($album->cover_art)
            <img src="{{ img_url($album->cover_art) }}" alt="{{ $album->title }} cover" width="400" height="400" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
            @else
            <div class="w-full h-full flex items-center justify-center text-surface-300 dark:text-ink-400">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.5" d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
            </div>
            @endif
        </div>
        <div class="p-3">
            <h2 class="font-display text-sm font-bold text-surface-900 dark:text-ink-100 group-hover:text-brand-600 dark:group-hover:text-brand-400 truncate leading-tight">{{ $album->title }}</h2>
            <div class="font-display text-[11px] font-bold text-surface-500 dark:text-ink-500 mt-1">
                <span>{{ $album->band->name }}</span>
                @if($album->release_year)
                <span class="mx-1">&middot;</span><span>{{ $album->release_year }}</span>
                @endif
            </div>
        </div>
    </a>
    @empty
    <div class="col-span-full card p-8 text-center"><p class="text-surface-500">{{ __('common.albums.no_albums') }}</p></div>
    @endforelse
</div>

<div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 font-display text-xs text-surface-500">
    <span class="font-bold uppercase tracking-wider">{{ $albums->firstItem() }}&ndash;{{ $albums->lastItem() }} {{ __('common.pagination.of') }} {{ $albums->total() }}</span>
    {{ $albums->appends(request()->query())->links('pagination::tailwind') }}
</div>
</div>
@endsection
