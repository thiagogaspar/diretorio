@php $minutes = max(1, intval(Str::of(strip_tags($content ?? ''))->wordCount() / 200)); @endphp
<span class="reading-time inline-flex items-center gap-1.5 text-xs sm:text-sm text-surface-500 dark:text-ink-400">
    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ $minutes }} {{ $minutes === 1 ? __('common.min_read') : __('common.min_read_plural') }}
</span>
