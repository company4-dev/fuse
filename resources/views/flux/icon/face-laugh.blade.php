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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 512 512" fill="currentColor">
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm72.7 58c-3.6-13.7 7.6-26 21.8-26l259.1 0c14.2 0 25.4 12.3 21.8 26c-18.1 68-79 118-151.3 118s-133.2-50-151.3-118zm95.7-122a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zm160 0a24 24 0 1 1 -48 0 24 24 0 1 1 48 0z"/><path class="fa-primary" d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM256 400c52 0 97.1-32.8 115.7-80l-231.4 0c18.6 47.2 63.7 80 115.7 80zM126.5 288l259.1 0c14.2 0 25.4 12.3 21.8 26c-18.1 68-79 118-151.3 118s-133.2-50-151.3-118c-3.6-13.7 7.6-26 21.8-26zm25.9-96a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm184-24a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
</svg>
