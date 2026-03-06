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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 384 512" fill="currentColor">
    <path style="opacity:0.4" d="M64 176l0 64c0 70.7 57.3 128 128 128s128-57.3 128-128l0-64L64 176z"/><path class="fa-primary" d="M128 16c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 96 32 0 0-96zm160 0c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 96 32 0 0-96zM16 144c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 0 64c0 83 63.1 151.2 144 159.2l0 96.8c0 8.8 7.2 16 16 16s16-7.2 16-16l0-96.8c80.9-8 144-76.2 144-159.2l0-64 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0-32 0L64 144l-32 0-16 0zM192 368c-70.7 0-128-57.3-128-128l0-64 256 0 0 64c0 70.7-57.3 128-128 128z"/>
</svg>
