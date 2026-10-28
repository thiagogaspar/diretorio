<div class="overflow-x-auto -mx-4 sm:mx-0">
    <div class="rounded-xl overflow-hidden shadow-sm border border-surface-200 dark:border-ink-700 bg-white dark:bg-ink-800 min-w-[280px]">
        @if(isset($header))
        <div class="border-b border-surface-200 dark:border-ink-700 px-4 py-2.5 bg-surface-50 dark:bg-ink-700 font-display text-xs font-bold uppercase tracking-wider text-surface-600 dark:text-ink-300">
            {{ $header }}
        </div>
        @endif
        {{ $slot }}
    </div>
</div>
