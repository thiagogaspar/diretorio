@extends('layouts.app')

@section('head')
@php
$photo = $band->photo;
$bandPhotoUrl = $photo ? img_url($photo) : null;
$heroImg = $band->hero_image ? img_url($band->hero_image) : null;
$heroPlaceholder = $heroImg ?: $bandPhotoUrl;

$seo = new \App\Values\SeoData(
    title: $band->name,
    description: Str::limit(strip_tags($band->bio ?? __('common.learn_about', ['name' => $band->name])), 160),
    type: 'music.group',
    image: $bandPhotoUrl,
    canonical: route('bands.show', $band),
    schema: json_encode([
        '@context'=>'https://schema.org',
        '@graph'=>[
            ['@type'=>'BreadcrumbList','itemListElement'=>[
                ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>url('/')],
                ['@type'=>'ListItem','position'=>2,'name'=>'Bands','item'=>route('bands.index')],
                ['@type'=>'ListItem','position'=>3,'name'=>$band->name],
            ]],
            array_filter([
                '@type'=>'MusicGroup',
                'name'=>$band->name,
                'url'=>route('bands.show',$band),
                'genre'=>$band->genres->pluck('name')->implode(', ') ?: null,
                'foundingDate'=>$band->formed_year ? (string)$band->formed_year : null,
                'dissolutionDate'=>$band->dissolved_year ? (string)$band->dissolved_year : null,
                'image'=>$bandPhotoUrl,
                'member'=>$band->artists->where('pivot.is_support', false)->map(fn($a)=>['@type'=>'Person','name'=>$a->name,'url'=>route('artists.show',$a)])->values()->toArray() ?: null,
                'album'=>$band->albums->map(fn($a)=>['@type'=>'MusicAlbum','name'=>$a->title,'url'=>route('albums.show',$a),'datePublished'=>$a->release_year ? (string)$a->release_year : null])->values()->toArray() ?: null,
                'location'=>$band->origin ?: null,
            ]),
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
);
@endphp
<x-seo-meta :seo="$seo" />
@if($heroPlaceholder)
<link rel="preload" href="{{ $heroPlaceholder }}" as="image" fetchpriority="high">
@endif
@endsection

@section('content')
<div class="max-w-6xl mx-auto px-4">
<!-- Hero — foto sem shapes -->
<section class="relative -mx-4 -mt-6 mb-8 overflow-hidden bg-black" style="aspect-ratio:16/4; max-height:45vh;">
    @if($heroPlaceholder)
    <img src="{{ $heroPlaceholder }}" alt="{{ $band->name }}" width="1920" height="480" class="absolute inset-0 w-full h-full object-cover opacity-30" fetchpriority="high" decoding="sync" sizes="100vw">
    @endif
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/20"></div>
    <div class="relative z-10 flex flex-col justify-end h-full">
        <div class="max-w-6xl mx-auto px-4 w-full pb-8 sm:pb-12 pt-6">
            <h1 class="font-display text-3xl sm:text-5xl md:text-6xl font-black text-white leading-none tracking-tight">{{ $band->name }}</h1>
            <div class="flex flex-wrap gap-2 mt-3">
                @if($band->formed_year)<span class="badge badge-hero">{{ $band->formed_year }}&ndash;{{ $band->dissolved_year ?? __('common.bands.present') }}</span>@endif
                @foreach($band->genres->take(3) as $genre)<span class="badge badge-hero text-white/50 border-white/15">{{ $genre->name }}</span>@endforeach
            </div>
        </div>
    </div>
</section>

<nav class="breadcrumb mb-6">
    <a href="{{ route('home') }}">{{ __('common.home_breadcrumb') }}</a><span>/</span>
    <a href="{{ route('bands.index') }}">{{ __('common.nav.bands') }}</a><span>/</span>
    <span>{{ $band->name }}</span>
</nav>

<div class="lg:flex lg:gap-10">
    <div class="flex-1 min-w-0 order-2 lg:order-1">
        <!-- Header compacto -->
        <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-surface-200 dark:border-ink-700">
            @if($bandPhotoUrl)
            <img src="{{ $bandPhotoUrl }}" alt="{{ $band->name }}" width="56" height="56" class="w-14 h-14 object-cover shrink-0 border-2 border-surface-200 dark:border-ink-600" loading="lazy">
            @endif
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    @if($band->label)
                    <a href="{{ route('labels.show', $band->label) }}" class="font-display text-xs font-bold uppercase tracking-wider text-surface-400 hover:text-brand-600 dark:hover:text-brand-400">{{ $band->label->name }}</a>
                    @endif
                    @if($band->origin)
                    <span class="text-xs text-surface-400">&middot; {{ $band->origin }}</span>
                    @endif
                </div>
                @auth
                @php $favCount = $band->favorites()->count(); @endphp
                <button x-data="{ fav: {{ auth()->user() && auth()->user()->hasFavorited($band) ? 'true' : 'false' }}, count: {{ $favCount }} }"
                    @click.prevent="fetch('{{ route('favorites.toggle-band', $band) }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }).then(r => r.json()).then(d => { fav = d.favorited; count = d.count; })"
                    class="font-display text-xs font-bold mt-1 hover:text-brand-600 dark:hover:text-brand-400" :class="fav ? 'text-brand-600 dark:text-brand-400' : 'text-surface-400'" title="{{ __('common.artists.favorite_title') }}">
                    <span x-text="fav ? '&hearts;' : '&loz;'"></span> <span x-text="count"></span>
                </button>
                @endauth
            </div>
        </div>

        <!-- Bio -->
        @if($band->bio)
        <div class="prose max-w-none mb-8">{!! \Stevebauman\Purify\Facades\Purify::clean($band->bio) !!}</div>
        @endif

        <!-- Members -->
        @php
            $officialMembers = $band->artists->where('pivot.is_support', false);
            $supportMembers = $band->artists->where('pivot.is_support', true);
        @endphp

        {{-- Official Members --}}
        <x-section-header tag="h2" :count="$officialMembers->count()">{{ __('common.bands.members_heading') }}</x-section-header>
        <x-data-table>
            @forelse($officialMembers as $artist)
            <div class="flex items-center justify-between px-4 py-2.5 border-b-2 border-surface-200 dark:border-ink-700 last:border-0 hover:bg-surface-50 dark:hover:bg-ink-700/50">
                <div class="flex items-center gap-2 min-w-0">
                    <a href="{{ route('artists.show', $artist) }}" class="font-display text-sm font-bold text-brand-600 dark:text-brand-400 hover:underline truncate">{{ $artist->name }}</a>
                    @if($artist->pivot->role)<span class="badge badge-surface text-[10px] shrink-0">{{ $artist->pivot->role }}</span>@endif
                </div>
                <span class="font-display text-[10px] font-bold text-surface-400 shrink-0 ml-3">{{ $artist->pivot->joined_year ?? '?' }}&ndash;{{ $artist->pivot->left_year ?? __('common.bands.present') }}</span>
            </div>
            @empty
            <p class="px-4 py-3 text-sm text-surface-400">{{ __('common.bands.no_members') }}</p>
            @endforelse
        </x-data-table>

        {{-- Support Members --}}
        @if($supportMembers->isNotEmpty())
        <x-section-header tag="h3" :count="$supportMembers->count()" class="mt-8">{{ __('common.bands.support_members_heading') }}</x-section-header>
        <x-data-table>
            @foreach($supportMembers as $artist)
            <div class="flex items-center justify-between px-4 py-2.5 border-b-2 border-surface-200 dark:border-ink-700 last:border-0 hover:bg-surface-50 dark:hover:bg-ink-700/50">
                <div class="flex items-center gap-2 min-w-0">
                    <a href="{{ route('artists.show', $artist) }}" class="font-display text-sm font-bold text-accent-600 dark:text-accent-400 hover:underline truncate">{{ $artist->name }}</a>
                    @if($artist->pivot->role)<span class="badge badge-accent text-[10px] shrink-0">{{ $artist->pivot->role }}</span>@endif
                    <span class="badge badge-surface text-[9px] shrink-0 opacity-60">{{ __('common.bands.support_member') }}</span>
                </div>
                <span class="font-display text-[10px] font-bold text-surface-400 shrink-0 ml-3">{{ $artist->pivot->joined_year ?? '?' }}&ndash;{{ $artist->pivot->left_year ?? '?' }}</span>
            </div>
            @endforeach
        </x-data-table>
        @endif

        <!-- Discography -->
        @if($band->albums->count())
        <x-section-header tag="h2" :count="$band->albums->count()" class="mt-10">{{ __('common.bands.discography') }}</x-section-header>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            @foreach($band->albums as $album)
            <a href="{{ route('albums.show', $album) }}" class="group">
                <div class="border-2 border-surface-200 dark:border-ink-700 bg-white dark:bg-ink-800 hover:border-brand-500 dark:hover:border-brand-400 transition-colors">
                    @php $cover = $album->cover_art ? img_url($album->cover_art) : null; @endphp
                    @if($cover)
                    <img src="{{ $cover }}" alt="{{ $album->title }}" width="400" height="400" class="w-full aspect-square object-cover" loading="lazy">
                    @else
                    <div class="w-full aspect-square bg-surface-100 dark:bg-ink-900 flex items-center justify-center text-surface-300 dark:text-ink-400">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="1.5" d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                    </div>
                    @endif
                </div>
                <div class="mt-2">
                    <h3 class="font-display text-sm font-bold text-surface-900 dark:text-ink-100 truncate group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $album->title }}</h3>
                    @if($album->release_year)<p class="font-display text-[10px] font-bold text-surface-400 dark:text-ink-400">{{ $album->release_year }}</p>@endif
                </div>
            </a>
            @endforeach
        </div>
        @endif

        <!-- Connection Graph -->
        @if(count($graph['nodes']) > 1)
        <x-section-header tag="h2" class="mt-10">{{ __('common.bands.connections') }}</x-section-header>
        <div class="border-2 border-surface-200 dark:border-ink-700 bg-surface-50 dark:bg-ink-800 overflow-hidden" style="height:350px">
            <x-genealogy-graph :graph="$graph" containerId="band-graph" />
        </div>
        @endif

    </div>

    <!-- Infobox — Wikipedia style -->
    <aside class="lg:w-72 mt-8 lg:mt-0 shrink-0 self-start order-1 lg:order-2 lg:sticky lg:top-16" role="complementary">
        <x-infobox :title="$band->name" :items="[
            __('common.bands.members_heading') => (string) $band->officialArtists()->count(),
            __('common.nav.albums') => $band->albums->count() ? (string) $band->albums->count() : null,
            __('common.bands.formed') => $band->formed_year ? (string) $band->formed_year : null,
            __('common.bands.dissolved') => $band->dissolved_year ? (string) $band->dissolved_year : null,
            __('common.bands.origin') => $band->origin ? e($band->origin) : null,
            __('common.bands.label') => $band->label ? e($band->label->name) : null,
            __('common.bands.genres') => $band->genres->count() ? e($band->genres->pluck('name')->implode(', ')) : null,
        ]" />
        <div class="mt-4"><x-ad-slot position="sidebar" /></div>
    </aside>
</div>
</div>
@endsection
