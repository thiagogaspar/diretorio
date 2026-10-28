@extends('layouts.app')

@section('head')
@php $seo = new \App\Values\SeoData(title: __('common.favorites.title'), description: __('common.favorites.seo_description')); @endphp
<x-seo-meta :seo="$seo" />
@endsection

@section('content')
<div class="max-w-6xl mx-auto px-4">
<div class="flex items-center gap-4 mb-8">
    <h1 class="font-display text-2xl sm:text-3xl font-bold text-surface-900 dark:text-ink-200">{{ __('common.favorites.title') }}</h1>
    <span class="h-px flex-1 bg-surface-200 dark:bg-ink-700"></span>
</div>

@guest
<div class="text-center py-16">
    <p class="text-surface-500 mb-4 text-sm">
        <a href="{{ route('register') }}" class="link font-semibold">{{ __('common.register') }}</a> {{ __('common.or') }}
        <a href="{{ route('filament.admin.auth.login') }}" class="link font-semibold">{{ __('common.auth.login') }}</a> {{ __('common.favorites.login_prompt_rest') }}
    </p>
</div>
@else
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse($favorites as $fav)
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
                <h3 class="font-display font-bold text-xs text-surface-900 dark:text-ink-100 group-hover:text-brand-600 dark:group-hover:text-brand-400 truncate">{{ $item->name }}</h3>
                <p class="text-[10px] text-surface-400 mt-1.5 uppercase tracking-wider">{{ class_basename($fav->favoriteable_type) }}</p>
            </div>
        </div>
    </a>
    @endif
    @empty
    <div class="col-span-full card p-8 text-center">
        <p class="text-surface-500 mb-4 text-sm">{{ __('common.favorites.no_favorites') }}</p>
        <a href="{{ route('bands.index') }}" class="btn btn-brand btn-sm">{{ __('common.favorites.browse_bands') }}</a>
    </div>
    @endforelse
</div>
@endguest
</div>
@endsection
