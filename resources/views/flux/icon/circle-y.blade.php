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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm100-85.5c-5.8-6.7-5.1-16.8 1.5-22.6s16.8-5.1 22.6 1.5L256 263.7 356 149.5c5.8-6.7 15.9-7.3 22.6-1.5s7.3 15.9 1.5 22.6L272 294l0 90c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-90L132 170.5z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM156 149.5c-5.8-6.7-15.9-7.3-22.6-1.5s-7.3 15.9-1.5 22.6L240 294l0 90c0 8.8 7.2 16 16 16s16-7.2 16-16l0-90L380 170.5c5.8-6.7 5.1-16.8-1.5-22.6s-16.8-5.1-22.6 1.5L256 263.7 156 149.5z"/>
</svg>
