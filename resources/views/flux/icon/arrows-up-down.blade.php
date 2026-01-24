@php
    $attributes = $unescapedForwardedAttributes ?? $attributes;
@endphp

@props([
    'variant' => 'outline',
])

@php
    $classes = Flux::classes('shrink-0')
        ->add(match($variant) {
            'outline' => '[:where(&)]:size-6',
            'solid' => '[:where(&)]:size-6',
            'mini' => '[:where(&)]:size-5',
            'micro' => '[:where(&)]:size-4',
        });
@endphp
{{-- Your SVG code here: --}}
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 320 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M171.3 4.7c-6.1-6.1-15.9-6.3-22.2-.4l-104 96c-6.5 6-6.9 16.1-.9 22.6s16.1 6.9 22.6 .9L144 52.5l0 404.8L75.3 388.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l96 96c6.2 6.2 16.4 6.2 22.6 0l96-96c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L176 457.4l0-402.7 68.7 68.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-96-96z"/>
</svg>
