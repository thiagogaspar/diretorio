@extends('layouts.app')

@section('head')
@php
$seo = new \App\Values\SeoData(title: __('common.profile.title'), description: __('common.profile.seo_description'));
@endphp
<x-seo-meta :seo="$seo" />
@endsection

@section('content')
<div class="max-w-6xl mx-auto px-4">
<div class="flex items-center gap-4 mb-8">
    <h1 class="font-display text-2xl sm:text-3xl font-bold text-surface-900 dark:text-ink-200">{{ __('common.profile.title') }}</h1>
    <span class="h-px flex-1 bg-surface-200 dark:bg-ink-700"></span>
</div>

<div class="lg:flex lg:gap-8">
    <div class="lg:w-72 shrink-0">
        <div class="card p-5 rounded-2xl">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center text-white font-display text-2xl font-bold shrink-0">
                    {{ strtoupper($user->name[0] ?? '?') }}
                </div>
                <div>
                    <h2 class="font-display font-bold text-lg text-surface-900 dark:text-ink-200">{{ $user->name }}</h2>
                    <p class="text-xs text-surface-400 mt-0.5">
                        @if($user->isAdmin())<span class="badge badge-brand">Admin</span>
                        @elseif($user->isEditor())<span class="badge badge-accent">Editor</span>
                        @else<span class="badge badge-surface">Viewer</span>@endif
                    </p>
                    <p class="text-[10px] text-surface-400 uppercase tracking-wider mt-1">Joined {{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 space-y-2">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-ghost btn-sm w-full justify-center text-xs">{{ __('common.profile.logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
            <div class="mt-4 pt-4 border-t border-surface-200 dark:border-ink-700 space-y-2 text-xs">
                <div class="flex justify-between"><span class="text-surface-400">{{ __('common.profile.favorites') }}</span><span class="font-bold text-surface-700 dark:text-ink-200">{{ $user->favorites->count() }}</span></div>
                <div class="flex justify-between"><span class="text-surface-400">{{ __('common.profile.suggestions') }}</span><span class="font-bold text-surface-700 dark:text-ink-200">{{ $suggestions->count() }}</span></div>
                <div class="flex justify-between"><span class="text-surface-400">{{ __('common.profile.comments') }}</span><span class="font-bold text-surface-700 dark:text-ink-200">{{ $user->comments->count() }}</span></div>
            </div>
        </div>
    </div>

    <div class="flex-1 min-w-0 mt-6 lg:mt-0">
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
            <p class="text-sm text-surface-500">{{ __('common.profile.no_favorites') }} <a href="{{ route('bands.index') }}" class="link">{{ __('common.favorites.browse_bands') }}</a></p>
            @endif
        </section>

        <!-- Suggestions -->
        <section class="mb-10">
            <h2 class="font-display text-xl font-bold mb-4 text-surface-900 dark:text-ink-200">{{ __('common.profile.suggestions') }}</h2>
            @if($suggestions->isEmpty())
            <p class="text-sm text-surface-500">{{ __('common.profile.no_suggestions') }}</p>
            @else
            <div class="card overflow-hidden divide-y divide-surface-200 dark:divide-ink-700">
                @foreach($suggestions as $s)
                <div class="px-4 py-3 flex items-center justify-between gap-3 hover:bg-surface-50 dark:hover:bg-ink-700/50 transition-colors">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm text-surface-700 dark:text-ink-200 truncate">
                            <span class="font-medium">{{ $s->field }}</span>
                            <span class="text-surface-400"> on </span>
                            <span class="text-surface-500">{{ class_basename($s->suggestable_type) }}</span>
                        </p>
                        <p class="text-[10px] text-surface-400 mt-0.5">{{ $s->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="badge @if($s->status === 'approved') badge-brand @elseif($s->status === 'rejected') badge-warm @else badge-surface @endif">
                        {{ $s->status }}
                    </span>
                </div>
                @endforeach
            </div>
            @endif
        </section>

        <!-- Comments -->
        <section class="mb-10">
            <h2 class="font-display text-xl font-bold mb-4 text-surface-900 dark:text-ink-200">{{ __('common.profile.comments') }}</h2>
            @if($user->comments->isEmpty())
            <p class="text-sm text-surface-500">{{ __('common.profile.no_comments') }}</p>
            @else
            <div class="card overflow-hidden divide-y divide-surface-200 dark:divide-ink-700">
                @foreach($user->comments as $c)
                <div class="px-4 py-3 hover:bg-surface-50 dark:hover:bg-ink-700/50 transition-colors">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm text-surface-700 dark:text-ink-200">{{ Str::limit($c->body, 120) }}</p>
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
                        <span class="badge {{ $c->is_approved ? 'badge-brand' : 'badge-warm' }}">
                            {{ $c->is_approved ? __('common.profile.status_approved') : __('common.profile.status_pending') }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </section>
    </div>
</div>
</div>
@endsection
