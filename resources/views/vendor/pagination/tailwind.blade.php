@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-wrap items-center gap-1.5 font-display">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="opacity-40 cursor-default px-2.5 py-1.5 text-xs uppercase tracking-wider rounded-lg border border-surface-200 dark:border-ink-700 text-surface-400 min-w-[2.25rem] text-center">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-2.5 py-1.5 text-xs uppercase tracking-wider rounded-lg border border-surface-200 dark:border-ink-700 text-surface-500 hover:text-brand-600 hover:border-brand-500 dark:hover:text-brand-400 dark:hover:border-brand-700 hover:shadow-sm transition-all duration-200 min-w-[2.25rem] text-center">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-2 py-1 text-xs text-surface-400 min-w-[1.75rem] text-center">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg bg-brand-600 text-white shadow-sm min-w-[2.25rem] text-center" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1.5 text-xs uppercase tracking-wider rounded-lg border border-surface-200 dark:border-ink-700 text-surface-500 hover:text-brand-600 hover:border-brand-500 dark:hover:text-brand-400 dark:hover:border-brand-700 hover:bg-surface-50 dark:hover:bg-ink-800 hover:shadow-sm transition-all duration-200 min-w-[2.25rem] text-center">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-2.5 py-1.5 text-xs uppercase tracking-wider rounded-lg border border-surface-200 dark:border-ink-700 text-surface-500 hover:text-brand-600 hover:border-brand-500 dark:hover:text-brand-400 dark:hover:border-brand-700 hover:shadow-sm transition-all duration-200 min-w-[2.25rem] text-center">&raquo;</a>
        @else
            <span class="opacity-40 cursor-default px-2.5 py-1.5 text-xs uppercase tracking-wider rounded-lg border border-surface-200 dark:border-ink-700 text-surface-400 min-w-[2.25rem] text-center">&raquo;</span>
        @endif
    </nav>
@endif
