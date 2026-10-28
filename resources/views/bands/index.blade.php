@extends('layouts.app')

@section('head')
@php
$filterLabel = '';
$genreSlug = $genreName ?? request('genre');
if ($genreSlug) { $genreLabel = $genres[$genreSlug] ?? $genreSlug; $filterLabel = "{$genreLabel} — "; }
if (request('label')) { $filterLabel = __('common.bands.label').': '.e(request('label')).' — '; }
if (request('origin')) { $filterLabel = e(request('origin')) . " — "; }
if (request('search')) { $filterLabel = __('common.bands.seo_search', ['query' => e(request('search'))]) . " — "; }
$seo = new \App\Values\SeoData(
    title: $filterLabel . (isset($genreName) ? $genreName . ' ' . __('common.nav.bands') : __('common.bands.all')),
    description: isset($genreName) ? __('common.bands.seo_description') : __('common.bands.seo_description'),
    canonical: isset($genreName) ? route('genres.show', request()->route('slug') ?? '') : route('bands.index'),
);
@endphp
<x-seo-meta :seo="$seo" />
@endsection

@php $qs = http_build_query(request()->except(['sort','dir'])); @endphp

@section('content')
<div class="max-w-6xl mx-auto px-4">
@isset($genreName)
<nav class="breadcrumb mb-5">
    <a href="{{ route('home') }}">{{ __('common.home_breadcrumb') }}</a><span>/</span>
    <a href="{{ route('bands.index') }}">{{ __('common.nav.bands') }}</a><span>/</span>
    <span>{{ $genreName }}</span>
</nav>
@endisset

<div class="flex items-center gap-4 mb-6">
    <h1 class="font-display text-xl sm:text-2xl font-bold text-surface-900 dark:text-ink-200">
        @isset($genreName){{ $genreName }}@else{{ __('common.nav.bands') }}@endisset
    </h1>
    <span class="h-px flex-1 bg-surface-200 dark:bg-ink-700"></span>
</div>

<!-- Filters -->
<form method="GET" class="p-4 bg-surface-50 dark:bg-ink-800/50 rounded-xl flex flex-col sm:flex-row flex-wrap gap-3 mb-6">
    <input name="search" value="{{ request('search') }}" placeholder="{{ __('common.bands.search') }}" aria-label="{{ __('common.bands.search_aria') }}" class="w-full sm:flex-1 sm:min-w-[200px] input">
    <select name="genre" aria-label="{{ __('common.bands.filter_genre_aria') }}" class="w-full sm:w-auto sm:max-w-[150px] select">
        <option value="">{{ __('common.bands.all_genres') }}</option>
        @foreach($genres as $slug => $name)
        <option value="{{ $slug }}" {{ (request('genre') ?? '') === $slug ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
    <input name="year" value="{{ request('year') }}" placeholder="{{ __('common.bands.year') }}" aria-label="{{ __('common.bands.filter_year_aria') }}" class="w-full sm:w-auto sm:max-w-[70px] input">
    <select name="origin" aria-label="{{ __('common.bands.filter_origin_aria') }}" class="w-full sm:w-auto sm:max-w-[130px] select">
        <option value="">{{ __('common.bands.all_origins') }}</option>
        @foreach($origins as $o)
        <option value="{{ $o }}" {{ request('origin') === $o ? 'selected' : '' }}>{{ $o }}</option>
        @endforeach
    </select>
    <button type="submit" class="w-full sm:w-auto btn bg-black text-white border-black hover:bg-surface-800 text-xs">{{ __('common.filter') }}</button>
</form>

<!-- Sort + count -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-6 font-display text-xs text-surface-500">
    <span class="font-bold uppercase tracking-wider">{{ trans_choice('common.bands.count', $bands->total()) }}</span>
    <div class="flex flex-wrap gap-2">
        <a href="?sort=name&dir={{ $sort === 'name' && $dir === 'asc' ? 'desc' : 'asc' }}&{{ $qs }}" class="px-3 py-1 rounded-full border border-surface-200 dark:border-ink-700 hover:border-brand-500 hover:text-brand-600 dark:hover:border-brand-700 dark:hover:text-brand-400 transition-colors {{ $sort === 'name' ? 'font-bold text-brand-600 dark:text-brand-400 border-brand-400 dark:border-brand-600' : 'text-surface-500' }}">
            {{ __('common.bands.sort_name') }} {{ $sort === 'name' ? ($dir === 'asc' ? '&uarr;' : '&darr;') : '' }}
        </a>
        <a href="?sort=formed_year&dir={{ $sort === 'formed_year' && $dir === 'asc' ? 'desc' : 'asc' }}&{{ $qs }}" class="px-3 py-1 rounded-full border border-surface-200 dark:border-ink-700 hover:border-brand-500 hover:text-brand-600 dark:hover:border-brand-700 dark:hover:text-brand-400 transition-colors {{ $sort === 'formed_year' ? 'font-bold text-brand-600 dark:text-brand-400 border-brand-400 dark:border-brand-600' : 'text-surface-500' }}">
            {{ __('common.bands.sort_year') }} {{ $sort === 'formed_year' ? ($dir === 'asc' ? '&uarr;' : '&darr;') : '' }}
        </a>
        <a href="?sort=genre&dir={{ $sort === 'genre' && $dir === 'asc' ? 'desc' : 'asc' }}&{{ $qs }}" class="px-3 py-1 rounded-full border border-surface-200 dark:border-ink-700 hover:border-brand-500 hover:text-brand-600 dark:hover:border-brand-700 dark:hover:text-brand-400 transition-colors {{ $sort === 'genre' ? 'font-bold text-brand-600 dark:text-brand-400 border-brand-400 dark:border-brand-600' : 'text-surface-500' }}">
            {{ __('common.bands.sort_genre') }} {{ $sort === 'genre' ? ($dir === 'asc' ? '&uarr;' : '&darr;') : '' }}
        </a>
    </div>
</div>

<!-- Card grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
@forelse($bands as $band)
    <a href="{{ route('bands.show', $band) }}" class="card overflow-hidden group">
        <div class="aspect-[3/2] overflow-hidden bg-surface-100 dark:bg-ink-900">
            @if($band->photo)
            <img src="{{ img_url($band->photo) }}" alt="{{ $band->name }}" width="400" height="267" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
            @else
            <div class="w-full h-full flex items-center justify-center text-surface-300 dark:text-ink-600">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.5" d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3" fill="currentColor"/><circle cx="18" cy="16" r="3" fill="currentColor"/></svg>
            </div>
            @endif
        </div>
        <div class="p-4">
            <h2 class="font-display text-base font-bold text-surface-900 dark:text-ink-100 group-hover:text-brand-600 dark:group-hover:text-brand-400 leading-tight truncate">{{ $band->name }}</h2>
            <div class="flex flex-wrap gap-1 mt-2">
                @if($band->formed_year)
                <span class="badge badge-surface text-[10px]">{{ $band->formed_year }}&ndash;{{ $band->dissolved_year ?? __('common.bands.present') }}</span>
                @endif
                @foreach($band->genres->take(2) as $genre)
                <span class="badge badge-surface text-[10px]">{{ $genre->name }}</span>
                @endforeach
            </div>
            <div class="font-display text-[11px] font-bold text-surface-400 dark:text-ink-400 mt-2 flex flex-wrap gap-x-2 gap-y-0.5">
                @if($band->origin)
                <span>{{ $band->origin }}</span>
                @if($band->artists_count || $band->label)<span class="text-surface-300 dark:text-ink-600">&middot;</span>@endif
                @endif
                @if($band->artists_count)
                <span>{{ $band->artists_count }} {{ $band->artists_count !== 1 ? __('common.bands.members') : __('common.bands.member') }}</span>
                @if($band->label)<span class="text-surface-300 dark:text-ink-600">&middot;</span>@endif
                @endif
                @if($band->label)
                <span>{{ $band->label->name }}</span>
                @endif
            </div>
        </div>
    </a>
@empty
    <div class="col-span-full card p-8 text-center">
        <p class="text-surface-500 mb-4">{{ __('common.bands.no_bands') }}</p>
        <a href="/admin/bands/create" class="btn bg-black text-white border-black hover:bg-surface-800">{{ __('common.bands.add_first') }}</a>
    </div>
@endforelse
</div>

<!-- Pagination -->
<div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 font-display text-xs text-surface-500">
    <span class="font-bold uppercase tracking-wider">{{ $bands->firstItem() }}&ndash;{{ $bands->lastItem() }} {{ __('common.pagination.of') }} {{ $bands->total() }}</span>
    {{ $bands->appends(request()->query())->links('pagination::tailwind') }}
</div>
</div>
@endsection
