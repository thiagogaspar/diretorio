<figure class="figure">
    <img src="{{ $src }}" alt="{{ $alt ?? '' }}" {{ $attributes->except(['src', 'alt', 'caption']) }} width="{{ $width ?? 800 }}" height="{{ $height ?? 450 }}" loading="lazy">
    @if($caption ?? false)
    <figcaption>{{ $caption }}</figcaption>
    @endif
</figure>
