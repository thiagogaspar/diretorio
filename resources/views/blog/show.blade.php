@extends('layouts.app')

@section('head')
@php
$seo = new \App\Values\SeoData(
    title: $post->title,
    description: $post->excerpt ?? Str::limit(strip_tags($post->body), 160),
    type: 'article',
    canonical: route('blog.show', $post),
    schema: json_encode([
        '@context'=>'https://schema.org',
        '@type'=>'Article',
        'headline'=>$post->title,
        'description'=>$post->excerpt ?? Str::limit(strip_tags($post->body), 160),
        'image'=>$post->featured_image ? img_url($post->featured_image) : null,
        'author'=>['@type'=>'Person','name'=>$post->author ?? config('app.name')],
        'publisher'=>['@type'=>'Organization','name'=>config('app.name')],
        'datePublished'=>$post->published_at?->toIso8601String(),
        'dateModified'=>$post->updated_at->toIso8601String(),
        'wordCount'=>intval(Str::of(strip_tags($post->body))->wordCount()),
        'mainEntityOfPage'=>['@type'=>'WebPage','@id'=>route('blog.show', $post)],
        'url'=>route('blog.show', $post),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
);
@endphp
<x-seo-meta :seo="$seo" />
@endsection

@section('content')
<div class="max-w-6xl mx-auto px-4">
<nav class="breadcrumb mb-6">
    <a href="{{ route('home') }}">{{ __('common.home_breadcrumb') }}</a><span>/</span>
    <a href="{{ route('blog.index') }}">{{ __('common.nav.blog') }}</a><span>/</span>
    <span>{{ $post->title }}</span>
</nav>

<article class="max-w-3xl mx-auto">
    @if($post->featured_image)
    <section class="relative -mx-4 mb-8 overflow-hidden bg-black" style="aspect-ratio:16/4; max-height:45vh;">
        <img src="{{ img_url($post->featured_image) }}" alt="{{ $post->title }}" width="1920" height="480" class="absolute inset-0 w-full h-full object-cover opacity-40" fetchpriority="high" decoding="sync" sizes="100vw">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/20"></div>
        <div class="relative z-10 flex flex-col justify-end h-full">
            <div class="max-w-6xl mx-auto px-4 w-full pb-8 sm:pb-12 pt-6">
                <h1 class="font-display text-3xl sm:text-5xl md:text-6xl font-black text-white leading-none tracking-tight">{{ $post->title }}</h1>
            </div>
        </div>
    </section>
    @else
    <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-black text-black dark:text-white leading-tight tracking-tight mb-4">{{ $post->title }}</h1>
    @endif

    <div class="flex items-center gap-2 mb-4 font-display text-sm font-bold text-surface-600 dark:text-ink-400 uppercase tracking-wider flex-wrap">
        <span>{{ $post->published_at->format('M j, Y') }}</span>
        <span class="mx-1">/</span>
        <span>{{ $post->author ?? config('app.name') }}</span>
        <span class="mx-1">/</span>
        <x-reading-time :content="$post->body" />
    </div>

    <x-byline name="{{ $post->author ?? config('app.name') }}" avatar="{{ $post->author_avatar ?? '' }}" bio="{{ $post->author_bio ?? '' }}" />

    <div class="border-t-4 border-black dark:border-white pt-8">
        <div class="prose max-w-none drop-cap">{!! \Stevebauman\Purify\Facades\Purify::clean($post->body) !!}</div>
    </div>

    <div class="mt-8">
        <x-share-buttons :title="$post->title" :url="route('blog.show', $post)" />
    </div>

    <div class="mt-12 pt-6 border-t-2 border-surface-200 dark:border-ink-700">
        <a href="{{ route('blog.index') }}" class="font-display font-bold text-black dark:text-white hover:underline">{!! __('common.blog.back') !!}</a>
    </div>
</article>
</div>
@endsection
