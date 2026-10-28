<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
    <style>
        :focus-visible { outline: 2px solid var(--color-brand-500); outline-offset: 2px; }
    </style>
</head>
<body class="min-h-screen font-sans antialiased bg-surface-50 dark:bg-black text-surface-900 dark:text-white">
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="text-center max-w-md w-full">
            <h1 class="font-display text-6xl sm:text-8xl font-bold text-brand-500 mb-2 sm:mb-4 leading-none">@yield('code')</h1>
            <h2 class="font-display text-lg sm:text-xl font-bold mb-2 text-surface-800 dark:text-ink-200">@yield('message')</h2>
            <p class="text-xs sm:text-sm text-surface-500 dark:text-ink-400 mb-6 px-2">@yield('description')</p>
            <a href="{{ route('home') }}" class="btn btn-brand inline-block" aria-label="Go to home page">{{ __('common.back_to_home') }}</a>
        </div>
    </div>
</body>
</html>
