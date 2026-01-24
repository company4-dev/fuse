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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm107.9-90.5c22.2-25.7 61-53.5 116.1-53.5s93.8 27.9 116.1 53.5c5.8 6.7 5.1 16.8-1.6 22.6s-16.8 5.1-22.6-1.6C330 165.8 299.4 144 256 144s-74 21.8-91.9 42.5c-5.8 6.7-15.9 7.4-22.6 1.6s-7.4-15.9-1.6-22.6zM200.4 304a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zm160 0a24 24 0 1 1 -48 0 24 24 0 1 1 48 0z"/><path class="fa-primary" d="M32 256a224 224 0 1 1 448 0A224 224 0 1 1 32 256zm480 0A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM164.1 186.5C182 165.8 212.6 144 256 144s74 21.8 91.9 42.5c5.8 6.7 15.9 7.4 22.6 1.6s7.4-15.9 1.6-22.6C349.8 139.9 311.1 112 256 112s-93.8 27.9-116.1 53.5c-5.8 6.7-5.1 16.8 1.6 22.6s16.8 5.1 22.6-1.6zM200.4 304a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zm136-24a24 24 0 1 0 0 48 24 24 0 1 0 0-48z"/>
</svg>
