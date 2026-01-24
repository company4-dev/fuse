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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 576 512" fill="currentColor">
    <path style="opacity:0.4" d="M160 288c0 65.3 48.9 119.1 112 127l0-127c0-8.8 7.2-16 16-16s16 7.2 16 16l0 127c63.1-7.9 112-61.7 112-127c0-70.7-57.3-128-128-128s-128 57.3-128 128z"/><path class="fa-primary" d="M288 56a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM272 288l0 127c-63.1-7.9-112-61.7-112-127c0-70.7 57.3-128 128-128s128 57.3 128 128c0 65.3-48.9 119.1-112 127l0-127c0-8.8-7.2-16-16-16s-16 7.2-16 16zm16 160a160 160 0 1 0 0-320 160 160 0 1 0 0 320zM568 288a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM32 312a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM120 96A24 24 0 1 0 72 96a24 24 0 1 0 48 0zm360 24a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM120 480a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zm360 24a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/>
</svg>
