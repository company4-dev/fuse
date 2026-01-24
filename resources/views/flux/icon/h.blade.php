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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M352 256l0 208c0 8.8 7.2 16 16 16s16-7.2 16-16l0-240 0-176c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 176L32 224 32 48c0-8.8-7.2-16-16-16S0 39.2 0 48L0 464c0 8.8 7.2 16 16 16s16-7.2 16-16l0-208 320 0z"/>
</svg>
