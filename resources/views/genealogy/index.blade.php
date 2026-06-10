@extends('layouts.app')

@section('head')
@php
$seo = new \App\Values\SeoData(
    title: __('common.genealogy.title'),
    description: __('common.genealogy.seo_description'),
    canonical: route('genealogy'),
);
@endphp
<x-seo-meta :seo="$seo" />
<style>
    body {
        background: radial-gradient(ellipse at 50% 50%, #0f0f1a 0%, #06060d 100%) !important;
        overflow: hidden;
    }
    .dark body {
        background: radial-gradient(ellipse at 50% 50%, #0f0f1a 0%, #06060d 100%) !important;
    }
    #full-genealogy-graph {
        position: fixed;
        inset: 0;
        top: 0;
        height: 100vh;
        height: 100dvh;
        z-index: 0;
        background: transparent;
    }
    #full-genealogy-graph canvas {
        border-radius: 0;
    }
    .graph-ui {
        position: fixed;
        z-index: 20;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
    .graph-legend {
        top: 24px;
        left: 24px;
        background: rgba(6, 6, 13, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 10px;
        padding: 16px 20px;
        min-width: 180px;
    }
    .graph-legend-title {
        font-family: 'JetBrains Mono', monospace;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.35);
        margin-bottom: 10px;
    }
    .graph-legend-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 4px 0;
        font-size: 11px;
        color: rgba(255, 255, 255, 0.6);
        font-family: 'Inter', system-ui, sans-serif;
    }
    .graph-legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 3px;
        flex-shrink: 0;
    }
    .graph-legend-dot.artist {
        border-radius: 50%;
        width: 8px;
        height: 8px;
    }
    .graph-zoom {
        bottom: 24px;
        left: 24px;
        display: flex;
        flex-direction: column;
        gap: 1px;
        background: rgba(6, 6, 13, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 10px;
        overflow: hidden;
    }
    .graph-zoom-btn {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.5);
        font-size: 18px;
        font-family: 'JetBrains Mono', monospace;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .graph-zoom-btn:hover {
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
    }
    .graph-zoom-btn:first-child {
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    .graph-status {
        bottom: 28px;
        right: 28px;
        font-size: 10px;
        color: rgba(255, 255, 255, 0.25);
        font-family: 'JetBrains Mono', monospace;
        letter-spacing: 0.04em;
    }
    .graph-hint {
        bottom: 28px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 10px;
        color: rgba(255, 255, 255, 0.2);
        font-family: 'Inter', system-ui, sans-serif;
    }
</style>
@endsection

@section('content')
<h1 class="sr-only">{{ __('common.genealogy.title') }}</h1>

<div id="full-genealogy-graph">
    <div class="flex items-center justify-center h-full">
        <div class="text-center">
            <svg class="w-8 h-8 animate-spin mx-auto mb-3 text-white/20" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            <p class="text-white/15 text-xs font-mono">{{ __('common.genealogy.fetching') }}</p>
        </div>
    </div>
</div>

<!-- Legend -->
<div class="graph-ui graph-legend">
    <div class="graph-legend-title">{{ __('common.genealogy.legend') }}</div>
    <div class="graph-legend-item">
        <span class="graph-legend-dot" style="background:#1a1a2e;border:2px solid #4466aa"></span>
        {{ __('common.genealogy.legend_band') }}
    </div>
    <div class="graph-legend-item">
        <span class="graph-legend-dot artist" style="background:#2a2a3e;border:2px solid #8888aa"></span>
        {{ __('common.genealogy.legend_artist') }}
    </div>
    <div class="border-t border-white/[0.06] mt-3 pt-3">
        <div class="graph-legend-item">
            <span style="display:inline-block;width:18px;border-top:2.5px solid #f59e0b;opacity:0.7"></span>
            {{ __('common.genealogy.legend_relationship') }}
        </div>
        <div class="graph-legend-item">
            <span style="display:inline-block;width:18px;border-top:1px dashed rgba(255,255,255,0.2)"></span>
            {{ __('common.genealogy.legend_membership') }}
        </div>
    </div>
</div>

<!-- Zoom -->
<div class="graph-ui graph-zoom">
    <button class="graph-zoom-btn" id="graph-zoom-in" title="{{ __('common.genealogy.zoom_in') }}">+</button>
    <button class="graph-zoom-btn" id="graph-zoom-out" title="{{ __('common.genealogy.zoom_out') }}">&minus;</button>
</div>

<!-- Status -->
<div class="graph-ui graph-status" id="graph-status">{{ __('common.genealogy.fetching') }}</div>

<!-- Hint -->
<div class="graph-ui graph-hint">{{ __('common.genealogy.hint') }}</div>

@vite(['resources/js/genealogy.js'])
@endsection
