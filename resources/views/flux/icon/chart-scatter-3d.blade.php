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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M272 48c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 232.6L37.7 451.8c-6.7 5.7-7.6 15.8-1.9 22.6s15.8 7.6 22.5 1.9L256 309 453.7 476.2c6.7 5.7 16.8 4.9 22.6-1.9s4.9-16.8-1.9-22.6L272 280.6 272 48zM384 88a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm24 168a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zm72-72a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM152 160a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM32 88a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM56 256A24 24 0 1 0 8 256a24 24 0 1 0 48 0zM256 472a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/>
</svg>
