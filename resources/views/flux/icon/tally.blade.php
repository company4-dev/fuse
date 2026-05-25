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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 640 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M128 32c8.8 0 16 7.2 16 16l0 249.8 96-32L240 48c0-8.8 7.2-16 16-16s16 7.2 16 16l0 207.1 96-32L368 48c0-8.8 7.2-16 16-16s16 7.2 16 16l0 164.5 96-32L496 48c0-8.8 7.2-16 16-16s16 7.2 16 16l0 121.8 74.9-25c8.4-2.8 17.4 1.7 20.2 10.1s-1.7 17.4-10.1 20.2L528 203.5 528 464c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-249.8-96 32L400 464c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-207.1-96 32L272 464c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-164.5-96 32L144 464c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-121.8-74.9 25c-8.4 2.8-17.4-1.7-20.2-10.1s1.7-17.4 10.1-20.2L112 308.5 112 48c0-8.8 7.2-16 16-16z"/>
</svg>
