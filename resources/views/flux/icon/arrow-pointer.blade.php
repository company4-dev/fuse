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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 320 512" fill="currentColor">
    <path style="opacity:0.4" d="M32 72L272 288l-129.3 0c-9.3 0-18.2 4.1-24.3 11.2L32 400 32 72z"/><path class="fa-primary" d="M0 426L0 55.2C0 42.4 10.4 32 23.2 32c5.7 0 11.2 2.1 15.4 5.9l274 243.6c4.7 4.2 7.4 10.2 7.4 16.5c0 12.2-9.9 22.1-22.1 22.1l-136.4 0 61.1 137.5c3.6 8.1 0 17.5-8.1 21.1s-17.5 0-21.1-8.1l-61-137.2L38.6 440.5C34.4 445.3 28.4 448 22 448c-12.2 0-22-9.9-22-22zM32 72l0 328 86.4-100.8c6.1-7.1 15-11.2 24.3-11.2L272 288 32 72z"/>
</svg>
