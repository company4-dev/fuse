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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M96 48c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 179.5-51.9 13C3.5 242.6-1.7 251.3 .5 259.9s10.8 13.8 19.4 11.6l44.1-11L64 440c0 22.1 17.9 40 40 40l264 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-264 0c-4.4 0-8-3.6-8-8l0-187.5 179.9-45c8.6-2.1 13.8-10.8 11.6-19.4s-10.8-13.8-19.4-11.6L96 219.5 96 48z"/>
</svg>
