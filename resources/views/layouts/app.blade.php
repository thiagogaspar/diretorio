<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="preload" href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" as="style">
    <link rel="preload" href="https://fonts.bunny.net/css?family=jetbrains-mono:400,500,600,700&display=swap" as="style">
    <link rel="preload" href="https://fonts.bunny.net/css?family=dm-serif-display:400|inter:400,500,600,700,800,900|jetbrains-mono:400,500,600,700|source-serif-4:ital,wght@0,400;0,600;0,700;1,400&display=swap" as="style">
    <link href="https://fonts.bunny.net/css?family=dm-serif-display:400|inter:400,500,600,700,800,900|jetbrains-mono:400,500,600,700|source-serif-4:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700|newsreader:ital,opsz,wght@0,14..72,400;0,14..72,500;0,14..72,600;1,14..72,400|geist-mono:400,500,600,700,800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://fonts.bunny.net/css?family=lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600|atkinson-hyperlegible:400,700|ibm-plex-mono:400,500,600,700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800,900|fira-code:400,500,600,700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://fonts.bunny.net/css?family=playfair-display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://fonts.bunny.net/css?family=nunito:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet" media="print" onload="this.media='all'">

    @yield('preload')

    <link rel="icon" href="/favicon.svg">
    <link rel="apple-touch-icon" href="/favicon.svg">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('head')

    <style>
        :focus-visible { outline: 2px solid var(--color-brand-500); outline-offset: 2px; }
        .skip-link { position: absolute; top: -100%; left: 0; z-index: 10000; padding: 0.5rem 1rem; background: var(--color-brand-500); color: white; font-weight: 600; font-size: 0.875rem; }
        .skip-link:focus { top: 0; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen font-sans antialiased bg-white dark:bg-black text-black dark:text-white">
    <a href="#main-content" class="skip-link">{{ __('common.skip_to_content') }}</a>

    <header class="sticky top-0 z-50 border-b border-surface-200/50 dark:border-ink-700/50 glass" x-data="{ menu: false }" role="banner">
        <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="text-lg font-bold text-brand-600 dark:text-brand-500 shrink-0 hover:text-brand-700 dark:hover:text-brand-400 transition-colors duration-200 tracking-tight">
                {{ config('app.name', 'DIRETÓRIO') }}
            </a>

            <nav class="hidden md:flex items-center gap-0.5 text-sm" aria-label="Main navigation">
                <a href="{{ route('bands.index') }}" class="px-4 py-2 font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('bands.*') ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : 'text-surface-500 dark:text-ink-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-surface-100 dark:hover:bg-ink-800' }}">{{ __('common.nav.bands') }}</a>
                <a href="{{ route('artists.index') }}" class="px-4 py-2 font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('artists.*') ? 'bg-accent-50 dark:bg-accent-900/20 text-accent-600 dark:text-accent-400' : 'text-surface-500 dark:text-ink-400 hover:text-accent-600 dark:hover:text-accent-400 hover:bg-surface-100 dark:hover:bg-ink-800' }}">{{ __('common.nav.artists') }}</a>
                <a href="{{ route('genealogy') }}" class="px-4 py-2 font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('genealogy') ? 'bg-warm-50 dark:bg-warm-900/20 text-warm-600 dark:text-warm-400' : 'text-surface-500 dark:text-ink-400 hover:text-warm-600 dark:hover:text-warm-400 hover:bg-surface-100 dark:hover:bg-ink-800' }}">{{ __('common.nav.genealogy') }}</a>
                <a href="{{ route('blog.index') }}" class="px-4 py-2 font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('blog.*') ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : 'text-surface-500 dark:text-ink-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-surface-100 dark:hover:bg-ink-800' }}">{{ __('common.nav.blog') }}</a>
                @auth
                <a href="{{ route('favorites.index') }}" class="px-4 py-2 font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('favorites.*') ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : 'text-surface-500 dark:text-ink-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-surface-100 dark:hover:bg-ink-800' }}">{{ __('common.nav.favorites') }}</a>
                @endauth
            </nav>

            <div class="flex items-center gap-0.5">
                <div class="hidden lg:block relative" x-data="searchBox()">
                    <form @submit.prevent class="relative">
                        <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-surface-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input x-model="query" @input.debounce.300ms="search()" @focus="if(query.length>=2) open=true" @keydown.escape="open=false"
                                placeholder="{{ __('common.search') }}..." x-ref="input" aria-label="{{ __('common.search') }}"
                               class="input w-36 lg:w-44 !pl-8 !py-1.5 text-xs">
                    </form>
                    <div x-show="open && (results.bands.length || results.artists.length)" @click.away="open = false" x-cloak
                         class="absolute top-full mt-1 right-0 w-72 bg-white dark:bg-ink-800 border border-surface-200 dark:border-ink-700 rounded-xl shadow-lg z-50 overflow-hidden">
                        <template x-if="results.bands.length">
                            <div>
                                <div class="px-3 pt-2 pb-1 text-[9px] font-bold text-surface-400 tracking-wider uppercase">{{ __('common.nav.bands') }}</div>
                                <template x-for="band in results.bands" :key="band.id">
                                    <button @click="select('band', band.slug)" class="w-full px-3 py-2 text-left hover:bg-brand-50 dark:hover:bg-brand-900/30 flex items-center justify-between transition-colors duration-200">
                                        <span class="font-semibold text-sm text-brand-600 dark:text-brand-400" x-text="band.name"></span>
                                        <span x-show="band.genre" class="badge badge-surface text-[10px]" x-text="band.genre"></span>
                                    </button>
                                </template>
                            </div>
                        </template>
                        <template x-if="results.artists.length">
                            <div>
                                <div class="px-3 pt-2 pb-1 text-[9px] font-bold text-surface-400 tracking-wider uppercase">{{ __('common.nav.artists') }}</div>
                                <template x-for="artist in results.artists" :key="artist.id">
                                    <button @click="select('artist', artist.slug)" class="w-full px-3 py-2 text-left hover:bg-accent-50 dark:hover:bg-accent-900/30 flex items-center justify-between transition-colors duration-200">
                                        <span class="font-semibold text-sm text-accent-600 dark:text-accent-400" x-text="artist.name"></span>
                                        <span x-show="artist.origin" class="text-[10px] text-surface-500 dark:text-ink-400" x-text="artist.origin"></span>
                                    </button>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                @auth
                @if(auth()->user()->isAdmin())
                <a href="/admin" class="hidden sm:inline px-2 py-1 text-xs text-surface-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors duration-200" title="{{ __('common.admin') }}" rel="nofollow">{{ __('common.admin') }}</a>
                @endif
                @endauth

                @auth
                <span class="hidden sm:inline text-xs text-surface-400 mx-1 truncate max-w-[100px]">{{ auth()->user()->name }}</span>
                @else
                <a href="{{ route('register') }}" class="hidden sm:inline px-2 py-1 text-xs text-surface-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors duration-200">{{ __('common.register') }}</a>
                @endauth

                <div x-data="themeSwitcher()" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="rounded-lg hover:bg-surface-100 dark:hover:bg-ink-800 px-2 py-1 text-xs font-mono font-bold text-surface-400 hover:text-surface-700 dark:hover:text-ink-300 uppercase tracking-wider transition-colors duration-200">
                        <span x-text="{ brutalist: 'BRS', 'midnight-neon': 'NEO', 'vintage-zine': 'VIN', swiss: 'SWI', editorial: 'EDI', soft: 'SFT' }[theme]">BRS</span>
                    </button>
                    <div x-show="open" x-cloak
                        class="absolute top-full right-0 mt-1 w-48 bg-white dark:bg-ink-800 border border-surface-200 dark:border-ink-700 rounded-xl shadow-lg overflow-hidden z-50 text-xs font-mono">
                        <button @click="setTheme('brutalist')"
                            class="w-full px-3 py-2 text-left hover:bg-surface-100 dark:hover:bg-ink-700 transition-colors duration-150"
                            :class="theme === 'brutalist' ? 'text-brand-600 dark:text-brand-400 font-bold' : 'text-surface-600 dark:text-ink-300'">
                            [B] Brutalist
                        </button>
                        <button @click="setTheme('midnight-neon')"
                            class="w-full px-3 py-2 text-left hover:bg-surface-100 dark:hover:bg-ink-700 transition-colors duration-150"
                            :class="theme === 'midnight-neon' ? 'text-brand-600 dark:text-brand-400 font-bold' : 'text-surface-600 dark:text-ink-300'">
                            [N] Neon
                        </button>
                        <button @click="setTheme('vintage-zine')"
                            class="w-full px-3 py-2 text-left hover:bg-surface-100 dark:hover:bg-ink-700 transition-colors duration-150"
                            :class="theme === 'vintage-zine' ? 'text-brand-600 dark:text-brand-400 font-bold' : 'text-surface-600 dark:text-ink-300'">
                            [V] Vintage
                        </button>
                        <button @click="setTheme('swiss')"
                            class="w-full px-3 py-2 text-left hover:bg-surface-100 dark:hover:bg-ink-700 transition-colors duration-150"
                            :class="theme === 'swiss' ? 'text-brand-600 dark:text-brand-400 font-bold' : 'text-surface-600 dark:text-ink-300'">
                            [S] Swiss
                        </button>
                        <button @click="setTheme('editorial')"
                            class="w-full px-3 py-2 text-left hover:bg-surface-100 dark:hover:bg-ink-700 transition-colors duration-150"
                            :class="theme === 'editorial' ? 'text-brand-600 dark:text-brand-400 font-bold' : 'text-surface-600 dark:text-ink-300'">
                            [E] Editorial
                        </button>
                        <button @click="setTheme('soft')"
                            class="w-full px-3 py-2 text-left hover:bg-surface-100 dark:hover:bg-ink-700 transition-colors duration-150"
                            :class="theme === 'soft' ? 'text-brand-600 dark:text-brand-400 font-bold' : 'text-surface-600 dark:text-ink-300'">
                            [T] Soft
                        </button>
                    </div>
                </div>
                </div>

                <button x-data="{ theme: localStorage.getItem('theme') || 'system' }"
                    @click="theme = theme === 'dark' ? 'light' : 'dark'; let isDark = theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches); document.documentElement.classList.toggle('dark', isDark); localStorage.setItem('theme', theme)"
                    class="p-2 text-surface-400 hover:text-surface-700 dark:hover:text-ink-300 hover:bg-surface-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200" aria-label="Toggle theme">
                    <svg class="w-4 h-4 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg class="w-4 h-4 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </button>

                <button @click="menu = !menu" class="md:hidden p-2 text-surface-400 hover:text-surface-700 dark:hover:text-ink-300 hover:bg-surface-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200" aria-label="{{ __('common.nav.menu_toggle') }}" :aria-expanded="menu">
                    <svg class="w-5 h-5" :class="menu ? 'hidden' : 'block'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg class="w-5 h-5" :class="menu ? 'block' : 'hidden'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <div x-show="menu" @click.away="menu = false" x-cloak class="md:hidden border-t border-surface-200/50 dark:border-ink-700/50 glass max-h-[80vh] overflow-y-auto">
            <div class="max-w-6xl mx-auto px-4 py-4 space-y-1">
                <div class="relative mb-3" x-data="searchBox()">
                    <form @submit.prevent class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-surface-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input x-model="query" @input.debounce.300ms="search()" @focus="if(query.length>=2) open=true" @keydown.escape="open=false" placeholder="{{ __('common.search') }}" aria-label="{{ __('common.search') }}" class="w-full pl-9 pr-3 py-2 text-sm input">
                    </form>
                    <div x-show="open && (results.bands.length || results.artists.length)" @click.away="open = false" x-cloak class="mt-1 bg-white dark:bg-ink-800 border border-surface-200 dark:border-ink-700 rounded-xl shadow-lg overflow-hidden">
                        <template x-if="results.bands.length">
                            <div>
                                <div class="px-3 pt-2 pb-1 text-[9px] font-bold text-surface-400 tracking-wider uppercase">{{ __('common.nav.bands') }}</div>
                                <template x-for="band in results.bands" :key="band.id">
                                    <button @click="select('band', band.slug)" class="w-full px-3 py-2 text-left hover:bg-brand-50 dark:hover:bg-brand-900/30 flex items-center justify-between transition-colors duration-200">
                                        <span class="font-semibold text-sm text-brand-600 dark:text-brand-400" x-text="band.name"></span>
                                    </button>
                                </template>
                            </div>
                        </template>
                        <template x-if="results.artists.length">
                            <div>
                                <div class="px-3 pt-2 pb-1 text-[9px] font-bold text-surface-400 tracking-wider uppercase">{{ __('common.nav.artists') }}</div>
                                <template x-for="artist in results.artists" :key="artist.id">
                                    <button @click="select('artist', artist.slug)" class="w-full px-3 py-2 text-left hover:bg-accent-50 dark:hover:bg-accent-900/30 flex items-center justify-between transition-colors duration-200">
                                        <span class="font-semibold text-sm text-accent-600 dark:text-accent-400" x-text="artist.name"></span>
                                    </button>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
                <a href="{{ route('bands.index') }}" class="block px-3 py-2 text-sm text-surface-700 dark:text-ink-200 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-surface-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200 font-medium">{{ __('common.nav.bands') }}</a>
                <a href="{{ route('artists.index') }}" class="block px-3 py-2 text-sm text-surface-700 dark:text-ink-200 hover:text-accent-600 dark:hover:text-accent-400 hover:bg-surface-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200 font-medium">{{ __('common.nav.artists') }}</a>
                <a href="{{ route('genealogy') }}" class="block px-3 py-2 text-sm text-surface-700 dark:text-ink-200 hover:text-warm-600 dark:hover:text-warm-400 hover:bg-surface-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200 font-medium">{{ __('common.nav.genealogy') }}</a>
                <a href="{{ route('blog.index') }}" class="block px-3 py-2 text-sm text-surface-700 dark:text-ink-200 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-surface-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200 font-medium">{{ __('common.nav.blog') }}</a>
                @auth
                <a href="{{ route('favorites.index') }}" class="block px-3 py-2 text-sm text-surface-700 dark:text-ink-200 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-surface-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200 font-medium">{{ __('common.nav.favorites') }}</a>
                @endauth
                @auth
                <div class="pt-2 mt-2 border-t border-surface-200 dark:border-ink-700">
                    @if(auth()->user()->isAdmin())
                    <a href="/admin" class="block px-3 py-2 text-xs text-surface-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-surface-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200">{{ __('common.admin') }}</a>
                    @endif
                    <span class="block px-3 py-1 text-xs text-surface-400">{{ auth()->user()->name }}</span>
                </div>
                @endauth
            </div>
        </div>
    </header>

    <main id="main-content" role="main" class="relative overflow-x-hidden">
        @yield('content')
    </main>

    <footer class="border-t border-surface-200 dark:border-ink-700 mt-12 bg-surface-50/80 dark:bg-ink-900/80" role="contentinfo">
        <div class="max-w-6xl mx-auto px-4 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="col-span-2 md:col-span-1">
                    <div class="mb-3">
                        <span class="text-lg font-bold text-brand-600 dark:text-brand-500 tracking-tight">{{ config('app.name', 'DIRETÓRIO') }}</span>
                    </div>
                    <p class="text-sm text-surface-500 dark:text-ink-400 max-w-xs leading-relaxed">{{ __('common.footer.tagline') }}</p>
                    <div class="flex gap-4 mt-5">
                        <a href="{{ route('bands.index') }}" class="text-xs font-bold uppercase tracking-wider text-surface-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors duration-200">{{ __('common.nav.bands') }}</a>
                        <a href="{{ route('artists.index') }}" class="text-xs font-bold uppercase tracking-wider text-surface-400 hover:text-accent-600 dark:hover:text-accent-400 transition-colors duration-200">{{ __('common.nav.artists') }}</a>
                        <a href="{{ route('labels.index') }}" class="text-xs font-bold uppercase tracking-wider text-surface-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors duration-200">{{ __('common.nav.labels') }}</a>
                    </div>
                </div>
                <nav role="navigation" aria-label="{{ __('common.footer.explore') }}">
                    <p class="text-xs font-bold uppercase tracking-wider text-surface-600 dark:text-ink-400 mb-4">{{ __('common.footer.explore') }}</p>
                    <div class="space-y-2.5 text-sm">
                        <a href="{{ route('bands.index') }}" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ __('common.nav.bands') }}</a>
                        <a href="{{ route('artists.index') }}" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ __('common.nav.artists') }}</a>
                        <a href="{{ route('albums.index') }}" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ __('common.nav.albums') }}</a>
                        <a href="{{ route('genealogy') }}" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ __('common.nav.genealogy') }}</a>
                        <a href="{{ route('blog.index') }}" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ __('common.nav.blog') }}</a>
                    </div>
                </nav>
                <nav role="navigation" aria-label="{{ __('common.footer.community') }}">
                    <p class="text-xs font-bold uppercase tracking-wider text-surface-600 dark:text-ink-400 mb-4">{{ __('common.footer.community') }}</p>
                    <div class="space-y-2.5 text-sm">
                        <a href="{{ route('register') }}" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ __('common.join') }}</a>
                        <a href="/admin" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ __('common.contribute') }}</a>
                        <a href="{{ route('labels.index') }}" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ __('common.footer.labels_az') }}</a>
                        <a href="/sitemap.xml" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ __('common.nav.sitemap') }}</a>
                    </div>
                </nav>
                <nav role="navigation" aria-label="{{ __('common.bands.genres') }}">
                    <p class="text-xs font-bold uppercase tracking-wider text-surface-600 dark:text-ink-400 mb-4">{{ __('common.bands.genres') }}</p>
                    <div class="space-y-2.5 text-sm">
                        @php $footerGenres = app(\App\Services\BandService::class)->getGenres(); @endphp
                        @foreach(array_slice($footerGenres, 0, 8) as $slug => $name)
                        <a href="{{ route('genres.show', $slug) }}" class="block text-surface-500 hover:text-surface-900 dark:hover:text-ink-100 hover:bg-surface-100 dark:hover:bg-ink-800 px-2 -mx-2 rounded-lg transition-all duration-200">{{ $name }}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="mt-12 pt-6 border-t border-surface-200 dark:border-ink-700 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-surface-400">
                <span>&copy; {{ date('Y') }} {{ config('app.name', 'DIRETÓRIO') }}. {{ __('common.footer.copyright') }}</span>
                <div class="flex gap-4">
                    <a href="/sitemap.xml" class="hover:text-surface-600 dark:hover:text-ink-300 transition-colors duration-200">{{ __('common.nav.sitemap') }}</a>
                    <a href="/admin" class="hover:text-surface-600 dark:hover:text-ink-300 transition-colors duration-200">Admin</a>
                </div>
            </div>
        </div>
    </footer>

    <tallstackui:script />
    @livewireScripts
</body>
</html>
