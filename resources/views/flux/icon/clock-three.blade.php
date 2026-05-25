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
    <path style="opacity:0.4" d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM240 112l0 144c0 8.8 7.2 16 16 16l112 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-96 0 0-128c0-8.8-7.2-16-16-16s-16 7.2-16 16z"/><path class="fa-primary" d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112l0 144c0 8.8 7.2 16 16 16l112 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-96 0 0-128c0-8.8-7.2-16-16-16s-16 7.2-16 16z"/>
</svg>
