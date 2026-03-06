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
    <path style="opacity:0.4" d="M32 66.9L396.1 192 32 317.1 32 66.9z"/><path class="fa-primary" d="M32 16C32 7.2 24.8 0 16 0S0 7.2 0 16L0 32 0 64 0 320l0 32L0 496c0 8.8 7.2 16 16 16s16-7.2 16-16l0-145.1L432.9 213.2c9.1-3.1 15.1-11.6 15.1-21.2s-6.1-18.1-15.1-21.2L32 33.1 32 16zm0 50.9L396.1 192 32 317.1 32 66.9z"/>
</svg>
