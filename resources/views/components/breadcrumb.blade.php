<nav class="bg-surface-50/50 dark:bg-ink-900/50 rounded-lg px-3 py-2 overflow-x-auto whitespace-nowrap text-xs sm:text-sm">
    <div class="flex items-center gap-1.5">
        @forelse($items as $item)
        <a href="{{ $item['url'] }}" class="text-surface-500 dark:text-ink-400 font-semibold hover:text-brand-600 dark:hover:text-brand-400 transition-colors duration-200 shrink-0">{{ $item['label'] }}</a>
        <svg class="w-3 h-3 text-surface-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        @empty
        @endforelse
        <span class="text-surface-700 dark:text-ink-200 font-semibold shrink-0">{{ $last }}</span>
    </div>
</nav>
