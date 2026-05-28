<blockquote class="pull-quote">
    {{ $slot }}
    @if($attributes->has('cite'))
    <cite>{{ $attributes->get('cite') }}</cite>
    @endif
</blockquote>
