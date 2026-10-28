<div class="byline flex items-start gap-3">
    @if($avatar ?? false)
    <img src="{{ $avatar }}" alt="{{ $name }}" class="byline-avatar w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover shrink-0 shadow-sm">
    @endif
    <div class="min-w-0">
        <div class="byline-name text-sm sm:text-base font-semibold text-surface-800 dark:text-ink-200">{{ $name }}</div>
        @if($bio ?? false)
        <div class="byline-bio text-xs sm:text-sm text-surface-500 dark:text-ink-400 mt-0.5">{{ $bio }}</div>
        @endif
    </div>
</div>
