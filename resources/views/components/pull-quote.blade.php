<blockquote class="pull-quote text-base sm:text-lg md:text-xl">
    {{ $slot }}
    @if($attributes->has('cite'))
    <cite class="block text-xs sm:text-sm mt-2 text-surface-500 dark:text-ink-400 not-italic">{{ $attributes->get('cite') }}</cite>
    @endif
</blockquote>
