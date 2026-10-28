@extends('layouts.app')

@section('head')
@php
$seo = new \App\Values\SeoData(
    title: request('search') ? __('common.artists.seo_search', ['query' => e(request('search'))]) : __('common.artists.all'),
    description: __('common.artists.seo_description'),
    canonical: route('artists.index'),
);
@endphp
<x-seo-meta :seo="$seo" />
@endsection

@php $qs = http_build_query(request()->except(['sort','dir'])); @endphp

@section('content')
<div class="max-w-6xl mx-auto px-4">
<div class="flex items-center gap-4 mb-6">
    <h1 class="font-display text-xl sm:text-2xl font-bold text-surface-900 dark:text-ink-200">{{ __('common.nav.artists') }}</h1>
    <span class="h-px flex-1 bg-surface-200 dark:bg-ink-700"></span>
</div>

<!-- Search + Sort -->
<div class="p-4 bg-surface-50 dark:bg-ink-800/50 rounded-xl flex flex-col sm:flex-row sm:items-center gap-3 mb-6">
    <form method="GET" class="flex-1">
        <input name="search" value="{{ request('search') }}" placeholder="{{ __('common.artists.search') }}" aria-label="{{ __('common.artists.search_aria') }}" class="w-full sm:max-w-[280px] input">
    </form>
    <div class="flex flex-wrap gap-2 font-display text-xs text-surface-500">
        <a href="?sort=name&dir={{ $sort === 'name' && $dir === 'asc' ? 'desc' : 'asc' }}&{{ $qs }}" class="px-3 py-1 rounded-full border border-surface-200 dark:border-ink-700 hover:border-accent-500 hover:text-accent-600 dark:hover:border-accent-700 dark:hover:text-accent-400 transition-colors {{ $sort === 'name' ? 'font-bold text-accent-600 dark:text-accent-400 border-accent-400 dark:border-accent-600' : 'text-surface-500' }}">
            {{ __('common.artists.sort_name') }} {{ $sort === 'name' ? ($dir === 'asc' ? '&uarr;' : '&darr;') : '' }}
        </a>
        <a href="?sort=origin&dir={{ $sort === 'origin' && $dir === 'asc' ? 'desc' : 'asc' }}&{{ $qs }}" class="px-3 py-1 rounded-full border border-surface-200 dark:border-ink-700 hover:border-accent-500 hover:text-accent-600 dark:hover:border-accent-700 dark:hover:text-accent-400 transition-colors {{ $sort === 'origin' ? 'font-bold text-accent-600 dark:text-accent-400 border-accent-400 dark:border-accent-600' : 'text-surface-500' }}">
            {{ __('common.artists.sort_origin') }} {{ $sort === 'origin' ? ($dir === 'asc' ? '&uarr;' : '&darr;') : '' }}
        </a>
    </div>
</div>

<div class="flex items-center justify-between mb-4 font-display text-xs text-surface-500">
    <span class="font-bold uppercase tracking-wider">{{ trans_choice('common.artists.count', $artists->total()) }}</span>
</div>

<!-- Card grid -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
@forelse($artists as $artist)
    <a href="{{ route('artists.show', $artist) }}" class="card overflow-hidden group">
        <div class="aspect-[2/3] overflow-hidden bg-accent-100 dark:bg-accent-900/30">
            @if($artist->photo)
            <img src="{{ img_url($artist->photo) }}" alt="{{ $artist->name }}" width="400" height="600" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
            @else
            <div class="w-full h-full flex items-center justify-center text-accent-300 dark:text-accent-700">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            @endif
        </div>
        <div class="p-3">
            <h2 class="font-display text-sm font-bold text-surface-900 dark:text-ink-100 group-hover:text-accent-600 dark:group-hover:text-accent-400 leading-tight truncate">{{ $artist->name }}</h2>
            <div class="flex flex-wrap gap-1 mt-1.5">
                @if($artist->origin)
                <span class="badge badge-surface text-[10px]">{{ $artist->origin }}</span>
                @endif
                @if($artist->birth_date)
                <span class="badge badge-surface text-[10px]">{{ $artist->birth_date->format('Y') }}@if($artist->death_date)&ndash;{{ $artist->death_date->format('Y') }}@endif</span>
                @endif
            </div>
            <div class="font-display text-[11px] font-bold text-surface-400 dark:text-ink-400 mt-2">
                <span>{{ trans_choice('common.artists.bands_count', $artist->bands->count()) }}</span>
            </div>
        </div>
    </a>
@empty
    <div class="col-span-full card p-8 text-center">
        <p class="text-surface-500 mb-4">{{ __('common.artists.no_artists') }}</p>
        <a href="/admin/artists/create" class="btn bg-black text-white border-black hover:bg-surface-800">{{ __('common.artists.add_first') }}</a>
    </div>
@endforelse
</div>

<!-- Pagination -->
<div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 font-display text-xs text-surface-500">
    <span class="font-bold uppercase tracking-wider">{{ $artists->firstItem() }}&ndash;{{ $artists->lastItem() }} {{ __('common.pagination.of') }} {{ $artists->total() }}</span>
    {{ $artists->appends(request()->query())->links('pagination::tailwind') }}
</div>
</div>
@endsection
