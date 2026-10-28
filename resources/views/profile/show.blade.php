@extends('layouts.app')

@section('head')
@php
$seo = new \App\Values\SeoData(
    title: $user->name,
    description: __('common.profile.seo_public', ['name' => $user->name]),
);
@endphp
<x-seo-meta :seo="$seo" />
@endsection

@section('content')
<div class="max-w-6xl mx-auto px-4">
<nav class="breadcrumb mb-8">
    <a href="{{ route('home') }}">{{ __('common.home_breadcrumb') }}</a><span>/</span>
    <span>{{ $user->name }}</span>
</nav>

<div class="lg:flex lg:gap-8">
    <div class="flex-1 min-w-0 order-2 lg:order-1 mt-6 lg:mt-0">
        <!-- Favorites -->
        <section class="mb-10">
            <h2 class="font-display text-xl font-bold mb-4 text-surface-900 dark:text-ink-200">{{ __('common.profile.favorites') }}</h2>
            @if($user->favorites->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @foreach($user->favorites as $fav)
                @php $item = $fav->favoriteable; @endphp
                @if($item)
                <a href="{{ $fav->favoriteable_type === 'App\Models\Band' ? route('bands.show', $item) : route('artists.show', $item) }}" class="block group">
                    <div class="card overflow-hidden h-full">
                        @if(method_exists($item, 'getAttribute') && $item->photo)
                        <div class="aspect-[3/2] overflow-hidden bg-surface-100 dark:bg-ink-900">
                            <img src="{{ img_url($item->photo) }}" alt="{{ $item->name }}" width="400" height="267" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        </div>
                        @endif
                        <div class="p-3">
                            <h3 class="font-display font-bold text-xs text-brand-600 dark:text-brand-400 truncate">{{ $item->name }}</h3>
                            <p class="text-[10px] text-surface-400 mt-1 uppercase tracking-wider">{{ class_basename($fav->favoriteable_type) }}</p>
                        </div>
                    </div>
                </a>
                @endif
                @endforeach
            </div>
            @else
            <p class="text-sm text-surface-500">{{ __('common.profile.no_public_favorites') }}</p>
            @endif
        </section>

        @if($user->comments->isNotEmpty())
        <section class="mb-10">
            <h2 class="font-display text-xl font-bold mb-4 text-surface-900 dark:text-ink-200">{{ __('common.profile.comments') }}</h2>
            <div class="card overflow-hidden divide-y divide-surface-200 dark:divide-ink-700">
                @foreach($user->comments as $c)
                <div class="px-4 py-3 hover:bg-surface-50 dark:hover:bg-ink-700/50 transition-colors">
                    <p class="text-sm text-surface-700 dark:text-ink-200">{{ Str::limit($c->body, 200) }}</p>
                    <p class="text-[10px] text-surface-400 mt-1">
                        {{ __('common.profile.on') }}
                        @if($c->commentable)
                        <a href="{{ $c->commentable_type === 'App\Models\Band' ? route('bands.show', $c->commentable) : route('artists.show', $c->commentable) }}" class="link font-medium">{{ $c->commentable->name }}</a>
                        @else
                        <span class="text-surface-400">{{ __('common.profile.deleted') }}</span>
                        @endif
                        &middot; {{ $c->created_at->diffForHumans() }}
                    </p>
                </div>
                @endforeach
            </div>
        </section>
        @else
        <p class="text-sm text-surface-500">{{ __('common.profile.no_public_comments') }}</p>
        @endif
    </div>

    <!-- Sidebar — profile card, below content on mobile -->
    <div class="lg:w-72 shrink-0 order-1 lg:order-2 mt-6 lg:mt-0">
        <div class="card p-5 text-center rounded-2xl">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center text-white font-display text-3xl font-bold mx-auto">
                {{ strtoupper($user->name[0] ?? '?') }}
            </div>
            <h1 class="font-display font-bold text-xl mt-3 text-surface-900 dark:text-ink-200">{{ $user->name }}</h1>
            <p class="text-xs text-surface-400 mt-1">{{ __('common.profile.member_since') }} {{ $user->created_at->format('M Y') }}</p>
            <div class="mt-3">
                @if($user->isAdmin())<span class="badge badge-brand">Admin</span>
                @elseif($user->isEditor())<span class="badge badge-accent">Editor</span>
                @else<span class="badge badge-surface">Viewer</span>@endif
            </div>
            <div class="mt-4 pt-4 border-t border-surface-200 dark:border-ink-700 space-y-2 text-xs">
                <div class="flex justify-between"><span class="text-surface-400">{{ __('common.profile.favorites') }}</span><span class="font-bold text-surface-700 dark:text-ink-200">{{ $user->favorites->count() }}</span></div>
                <div class="flex justify-between"><span class="text-surface-400">{{ __('common.profile.comments') }}</span><span class="font-bold text-surface-700 dark:text-ink-200">{{ $user->comments->count() }}</span></div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
