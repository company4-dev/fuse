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
    <path style="opacity:0.4" d="M32 256c0 123.7 100.3 224 224 224c112.8 0 206.2-83.4 221.7-192L272 288c-26.5 0-48-21.5-48-48l0-205.7C115.4 49.8 32 143.2 32 256z"/><path class="fa-primary" d="M477.7 288L272 288c-26.5 0-48-21.5-48-48l0-205.7C115.4 49.8 32 143.2 32 256c0 123.7 100.3 224 224 224c112.8 0 206.2-83.4 221.7-192zm2.3-32C480 132.3 379.7 32 256 32l0 208c0 8.8 7.2 16 16 16l208 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
</svg>
