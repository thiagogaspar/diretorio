@extends('layouts.app')

@section('head')
@php $seo = new \App\Values\SeoData(title: __('common.blog.title'), description: __('common.blog.seo_description'), canonical: route('blog.index')); @endphp
<x-seo-meta :seo="$seo" />
@endsection

@section('content')
<!-- Hero — gradient background -->
<section class="-mx-4 -mt-6 mb-10 bg-gradient-to-br from-brand-900 via-brand-800 to-ink">
    <div class="max-w-6xl mx-auto px-4 w-full py-14 sm:py-16">
        <p class="font-display text-xs font-bold tracking-[0.2em] uppercase text-white/40 mb-3">{{ config('app.name', 'DIRETÓRIO') }}</p>
        <h1 class="font-display text-4xl sm:text-6xl md:text-7xl font-black text-white leading-none tracking-tight">{{ __('common.blog.title') }}</h1>
        <p class="mt-2 text-white/50 font-serif text-base max-w-lg">{{ __('common.blog.subtitle') }}</p>
    </div>
</section>

<div class="max-w-6xl mx-auto px-4">
<div class="space-y-4">
    @forelse($posts as $post)
    <a href="{{ route('blog.show', $post) }}" class="card overflow-hidden group flex flex-col sm:flex-row items-start gap-4 sm:gap-5 p-4 sm:p-5">
        @if($post->featured_image)
        <img src="{{ img_url($post->featured_image) }}" alt="{{ $post->title }}" width="320" height="180" class="w-full sm:w-48 h-48 sm:h-32 object-cover shrink-0 rounded-xl" loading="lazy">
        @endif
        <div class="min-w-0 flex-1">
            <h2 class="font-display text-lg font-bold text-surface-900 dark:text-ink-100 group-hover:text-brand-600 dark:group-hover:text-brand-400 leading-tight">{{ $post->title }}</h2>
            <div class="flex flex-wrap items-center gap-2 mt-2">
                <span class="badge badge-surface">{{ $post->published_at->format('M j, Y') }}</span>
                <span class="badge badge-surface">{{ $post->author ?? config('app.name') }}</span>
                <x-reading-time :content="$post->body" />
            </div>
            @if($post->excerpt)
            <p class="font-serif text-sm text-surface-600 dark:text-ink-300 mt-2 leading-relaxed">{{ $post->excerpt }}</p>
            @endif
        </div>
        <span class="hidden sm:flex items-center text-surface-400 dark:text-ink-500 shrink-0 font-bold text-lg group-hover:text-brand-500 dark:group-hover:text-brand-400 transition-colors">&rarr;</span>
    </a>
    @empty
    <div class="card p-10 text-center text-surface-500 dark:text-ink-400 font-bold">{{ __('common.blog.no_posts') }}</div>
    @endforelse
</div>

<div class="mt-8 border-t-2 border-surface-200 dark:border-ink-700 pt-6 flex justify-center sm:justify-start">{{ $posts->links('pagination::tailwind') }}</div>
</div>
@endsection
