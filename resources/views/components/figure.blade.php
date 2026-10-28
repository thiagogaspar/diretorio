<figure class="figure max-w-full">
    <img src="{{ $src }}" alt="{{ $alt ?? '' }}" {{ $attributes->except(['src', 'alt', 'caption']) }} width="{{ $width ?? 800 }}" height="{{ $height ?? 450 }}" loading="lazy" class="max-w-full h-auto">
    @if($caption ?? false)
    <figcaption class="text-xs sm:text-sm mt-1 text-surface-500 dark:text-ink-400">{{ $caption }}</figcaption>
    @endif
</figure>
