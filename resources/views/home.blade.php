@extends('layouts.app')

@section('head')
@php
$seo = new \App\Values\SeoData(
    title: 'Genealogia de Bandas',
    description: 'Explore connections between bands and artists. A community-built directory of local original music.',
    canonical: url('/'),
    schema: json_encode([
        '@context'=>'https://schema.org',
        '@graph'=>[
            ['@type'=>'WebSite','name'=>'DIRETÓRIO','url'=>url('/'),'potentialAction'=>['@type'=>'SearchAction','target'=>url('/bands?search={search_term_string}'),'query-input'=>'required name=search_term_string']],
            ['@type'=>'Organization','name'=>'DIRETÓRIO','url'=>url('/'),'logo'=>url('/favicon.svg')],
        ],
    ], JSON_UNESCAPED_SLASHES),
);
@endphp
<x-seo-meta :seo="$seo" />
<style>
.home-hero {
    min-height: 42vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
</style>
@endsection

@section('content')
<!-- Hero — modern gradient with glass card -->
<section class="home-hero -mx-4 -mt-6 mb-10 bg-gradient-to-br from-brand-900 via-brand-800 to-ink relative overflow-hidden">
    <!-- Decorative blobs for visual depth -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-400/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-accent-400/10 rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-6xl mx-auto px-4 w-full py-16 sm:py-20 relative z-10">
        <div class="lg:flex lg:items-center lg:gap-12 xl:gap-16">
            <div class="flex-1 min-w-0">
                <p class="font-display text-xs font-bold tracking-[0.2em] uppercase text-white/40 mb-4">{{ __('common.home.hero_tag') }}</p>
                <h1 class="text-5xl sm:text-7xl md:text-8xl font-black text-white leading-none tracking-tight max-w-4xl">{!! __('common.home.hero_title') !!}</h1>
                <p class="mt-4 text-base sm:text-lg text-white/50 max-w-xl leading-relaxed font-serif">{{ __('common.home.hero_subtitle') }}</p>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-8">
                    <a href="{{ route('bands.index') }}" class="btn bg-white text-black border-white hover:bg-white/90 tracking-wider font-bold text-center">{{ __('common.home.browse_bands') }} &rarr;</a>
                    <a href="{{ route('genealogy') }}" class="btn text-white/70 border-2 border-white/20 hover:border-white/50 hover:text-white tracking-wider font-bold text-center">{{ __('common.home.view_graph') }}</a>
                </div>
            </div>
            @if($heroBand)
            <div class="shrink-0 mt-8 lg:mt-0 lg:w-72">
                <div class="glass-card overflow-hidden p-6 group">
                    <p class="font-display text-[10px] font-bold tracking-[0.15em] uppercase text-white/50 mb-3">{{ __('common.home.featured_band') }}</p>
                    @if($heroBand->photo)
                    <img src="{{ img_url($heroBand->photo) }}" alt="{{ $heroBand->name }}" width="600" height="400" class="w-full aspect-[3/2] object-cover rounded-lg" fetchpriority="high" decoding="sync">
                    @else
                    <div class="w-full aspect-[3/2] bg-white/5 rounded-lg flex items-center justify-center text-white/20 font-display text-4xl font-black">{{ $heroBand->name[0] }}</div>
                    @endif
                    <h3 class="font-display font-bold text-lg text-white mt-4 leading-tight">{{ $heroBand->name }}</h3>
                    <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1.5">
                        @foreach($heroBand->genres->take(2) as $genre)
                        <span class="font-display text-[10px] font-bold tracking-wider uppercase text-white/50">{{ $genre->name }}</span>
                        @if(!$loop->last)<span class="text-white/20 text-[8px]">|</span>@endif
                        @endforeach
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        @if($heroBand->formed_year)
                        <span class="font-display text-[10px] text-white/40">{{ $heroBand->formed_year }}{{ $heroBand->dissolved_year ? '&ndash;'.$heroBand->dissolved_year : '&ndash;'.__('common.home.present') }}</span>
                        @endif
                        @if($heroBand->origin)
                        <span class="text-white/20 text-[8px]">/</span>
                        <span class="font-display text-[10px] text-white/40">{{ $heroBand->origin }}</span>
                        @endif
                    </div>
                    <a href="{{ route('bands.show', $heroBand) }}" class="inline-block mt-3 font-display text-[11px] font-bold tracking-wider uppercase text-white/60 hover:text-white transition-colors">{{ __('common.home.explore', ['name' => $heroBand->name]) }} &rarr;</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Stats bar — modern cards with gradient text -->
<div class="max-w-6xl mx-auto px-4 mb-12">
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="rounded-2xl shadow-sm bg-brand-50 dark:bg-brand-900/20 p-6 text-center">
            <div class="stat-value-brand">{{ number_format($stats['bands']) }}</div>
            <div class="stat-desc">{{ __('common.home.bands') }}</div>
        </div>
        <div class="rounded-2xl shadow-sm bg-accent-50 dark:bg-accent-900/20 p-6 text-center">
            <div class="stat-value-accent">{{ number_format($stats['artists']) }}</div>
            <div class="stat-desc">{{ __('common.home.artists') }}</div>
        </div>
        <div class="rounded-2xl shadow-sm bg-warm-50 dark:bg-warm-900/20 p-6 text-center">
            <div class="stat-value-warm">{{ number_format($stats['memberships']) }}</div>
            <div class="stat-desc">{{ __('common.home.links') }}</div>
        </div>
        <div class="rounded-2xl shadow-sm bg-surface-100 dark:bg-ink-800 p-6 text-center">
            <div class="stat-value text-surface-700 dark:text-ink-200">{{ number_format($stats['relationships']) }}</div>
            <div class="stat-desc">{{ __('common.home.connections') }}</div>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4">
<!-- Featured Bands — card grid 3-col -->
<section class="mb-12">
    <x-section-header tag="h2">
        {{ __('common.home.featured_bands') }}
        <x-slot:action>
            <a href="{{ route('bands.index') }}" class="font-display text-xs font-bold text-surface-400 hover:text-brand-600 dark:hover:text-brand-400 shrink-0 ml-4">{{ __('common.view_all') }} &rarr;</a>
        </x-slot:action>
    </x-section-header>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($featuredBands as $band)
            <a href="{{ route('bands.show', $band) }}" class="card overflow-hidden group">
                @if($band->photo)
                <img src="{{ img_url($band->photo) }}" alt="{{ $band->name }}" width="600" height="400" class="w-full aspect-[3/2] object-cover" loading="lazy">
                @else
                <div class="w-full aspect-[3/2] bg-surface-100 dark:bg-ink-900 flex items-center justify-center">
                    <svg class="w-10 h-10 text-surface-300 dark:text-ink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.2" d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3" fill="currentColor"/><circle cx="18" cy="16" r="3" fill="currentColor"/></svg>
                </div>
                @endif
                <div class="p-4">
                    <h3 class="font-display font-bold text-sm text-surface-900 dark:text-ink-100 group-hover:text-brand-600 dark:group-hover:text-brand-400 leading-tight">{{ $band->name }}</h3>
                    <div class="text-[11px] text-surface-500 dark:text-ink-500 leading-relaxed mt-1.5">
                        @if($band->formed_year)<span>{{ $band->formed_year }}&ndash;{{ $band->dissolved_year ?? __('common.home.present') }}</span> · @endif
                        @foreach($band->genres->take(2) as $genre){{ $genre->name }}@if(!$loop->last), @endif @endforeach
                        @if($band->origin)· {{ $band->origin }}@endif
                    </div>
                </div>
            </a>
        @empty
            <div class="card p-6 text-sm text-surface-400 text-center col-span-3">{{ __('common.home.no_featured_bands') }}</div>
        @endforelse
    </div>
</section>

<!-- Featured Artists — card grid -->
<section class="mb-12">
    <x-section-header tag="h2">
        {{ __('common.home.featured_artists') }}
        <x-slot:action>
            <a href="{{ route('artists.index') }}" class="font-display text-xs font-bold text-surface-400 hover:text-brand-600 dark:hover:text-brand-400 shrink-0 ml-4">{{ __('common.view_all') }} &rarr;</a>
        </x-slot:action>
    </x-section-header>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($featuredArtists as $artist)
            <a href="{{ route('artists.show', $artist) }}" class="card overflow-hidden group">
                @if($artist->photo)
                <img src="{{ img_url($artist->photo) }}" alt="{{ $artist->name }}" width="400" height="600" class="w-full aspect-[2/3] object-cover" loading="lazy">
                @else
                <div class="w-full aspect-[2/3] bg-accent-100 dark:bg-accent-900/30 flex items-center justify-center">
                    <svg class="w-10 h-10 text-accent-300 dark:text-accent-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                @endif
                <div class="p-4">
                    <h3 class="font-display font-bold text-sm text-surface-900 dark:text-ink-100 group-hover:text-brand-600 dark:group-hover:text-brand-400 leading-tight">{{ $artist->name }}</h3>
                    @if($artist->origin)
                    <div class="text-[11px] text-surface-500 dark:text-ink-500 mt-1">{{ $artist->origin }}</div>
                    @endif
                </div>
            </a>
        @empty
            <div class="card p-6 text-sm text-surface-400 text-center col-span-3">{{ __('common.home.no_featured_artists') }}</div>
        @endforelse
    </div>
</section>

<!-- Featured Labels -->
<section class="mb-12">
    <x-section-header tag="h2">
        {{ __('common.home.labels') }}
        <x-slot:action>
            <a href="{{ route('labels.index') }}" class="font-display text-xs font-bold text-surface-400 hover:text-brand-600 dark:hover:text-brand-400 shrink-0 ml-4">{{ __('common.view_all') }} &rarr;</a>
        </x-slot:action>
    </x-section-header>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @forelse($featuredLabels as $label)
        <a href="{{ route('labels.show', $label) }}" class="card overflow-hidden group flex items-center gap-4 p-4">
            @if($label->logo)
            <img src="{{ img_url($label->logo) }}" alt="{{ $label->name }} logo" width="48" height="48" class="w-12 h-12 object-contain shrink-0 rounded-xl" loading="lazy">
            @else
            <div class="w-12 h-12 shrink-0 bg-surface-100 dark:bg-ink-900 flex items-center justify-center text-surface-400 dark:text-ink-500 font-display text-sm font-bold rounded-xl">{{ $label->name[0] }}</div>
            @endif
            <div class="min-w-0 flex-1">
                <h3 class="font-display font-bold text-sm text-surface-900 dark:text-ink-100 group-hover:text-brand-600 dark:group-hover:text-brand-400 truncate">{{ $label->name }}</h3>
                <div class="text-[11px] text-surface-500 dark:text-ink-500">{{ trans_choice('common.labels.bands_count', $label->bands_count) }}@if($label->country) · {{ $label->country }}@endif</div>
            </div>
        </a>
        @empty
        <div class="card p-6 text-sm text-surface-400 text-center col-span-4">{{ __('common.home.no_labels') }}</div>
        @endforelse
    </div>
</section>

<!-- CTA — modern gradient card -->
<section class="rounded-2xl bg-gradient-to-br from-surface-100 to-surface-200 dark:from-ink-800 dark:to-ink-900 p-10 sm:p-12 mb-8 text-center">
    <div class="max-w-xl mx-auto">
        <h2 class="font-display text-2xl font-black text-surface-900 dark:text-ink-100 mb-3">{{ __('common.home.cta_title') }}</h2>
        <p class="text-surface-500 dark:text-ink-400 text-sm mb-6 font-serif">{{ __('common.home.cta_desc') }}</p>
        <a href="/admin" class="btn btn-brand text-sm">{{ __('common.home.cta_button') }} &rarr;</a>
        <p class="text-xs text-surface-400 dark:text-ink-500 mt-4">{{ __('common.contribute') }} <a href="{{ route('register') }}" class="link">{{ __('common.home.cta_register') }}</a></p>
    </div>
</section>
</div>
@endsection
