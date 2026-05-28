<div class="byline">
    @if($avatar ?? false)
    <img src="{{ $avatar }}" alt="{{ $name }}" class="byline-avatar">
    @endif
    <div>
        <div class="byline-name">{{ $name }}</div>
        @if($bio ?? false)
        <div class="byline-bio">{{ $bio }}</div>
        @endif
    </div>
</div>
