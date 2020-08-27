<div style="font-family: Roboto;">
    <div>
        {!! $body !!}
    </div>
    @if ($photoPath)
    <img style="max-width: 700px" src="{{ $photoPath }}" alt="{{ $subject }}">
    @endif
</div>
