<div class="infobox w-full">
    <div class="border-b border-surface-200 dark:border-ink-700 px-4 py-2.5 bg-surface-100/80 dark:bg-ink-700/80">
        <h3 class="font-display font-bold text-xs uppercase tracking-wider text-surface-700 dark:text-ink-200">{{ $title ?? __('common.labels.info') }}</h3>
    </div>
    <table class="w-full text-xs sm:text-sm">
        @foreach($items as $label => $value)
        @if($value)
        <tr class="border-b border-surface-200 dark:border-ink-700 last:border-0 transition-colors duration-200 hover:bg-surface-100/50 dark:hover:bg-ink-700/30">
            <td class="infobox-label whitespace-nowrap align-top">{{ $label }}</td>
            <td class="infobox-value w-full break-words">{{ $value }}</td>
        </tr>
        @endif
        @endforeach
    </table>
</div>
