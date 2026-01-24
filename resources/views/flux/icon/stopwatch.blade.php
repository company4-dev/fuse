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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 448 512" fill="currentColor">
    <path style="opacity:0.4" d="M400 304A176 176 0 1 1 48 304a176 176 0 1 1 352 0zM208 208l0 112c0 8.8 7.2 16 16 16s16-7.2 16-16l0-112c0-8.8-7.2-16-16-16s-16 7.2-16 16z"/><path class="fa-primary" d="M128 16c0-8.8 7.2-16 16-16L304 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0 0 64.6c49.4 3.8 94 24.8 127.7 57l37-37c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6l-38.2 38.2C416 212.6 432 256.4 432 304c0 114.9-93.1 208-208 208S16 418.9 16 304c0-109.5 84.6-199.2 192-207.4L208 32l-64 0c-8.8 0-16-7.2-16-16zM48 304a176 176 0 1 0 352 0A176 176 0 1 0 48 304zm192-96l0 112c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-112c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
</svg>
