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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm48 0c0-97.2 78.8-176 176-176c8.8 0 16 7.2 16 16s-7.2 16-16 16c-79.5 0-144 64.5-144 144c0 8.8-7.2 16-16 16s-16-7.2-16-16zm272 0a96 96 0 1 1 -192 0 96 96 0 1 1 192 0z"/><path class="fa-primary" d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm320 0a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zm-160 0a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm72 0a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm-120 0c0 8.8-7.2 16-16 16s-16-7.2-16-16c0-97.2 78.8-176 176-176c8.8 0 16 7.2 16 16s-7.2 16-16 16c-79.5 0-144 64.5-144 144z"/>
</svg>
