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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm97.7 88.8l112-224c2.7-5.4 8.3-8.8 14.3-8.8s11.6 3.4 14.3 8.8l112 224c4 7.9 .7 17.5-7.2 21.5s-17.5 .7-21.5-7.2L326.1 304l-140.2 0-27.6 55.2c-4 7.9-13.6 11.1-21.5 7.2s-11.1-13.6-7.2-21.5zM201.9 272l108.2 0L256 163.8 201.9 272z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-400c-6.1 0-11.6 3.4-14.3 8.8l-112 224c-4 7.9-.7 17.5 7.2 21.5s17.5 .7 21.5-7.2L185.9 304l140.2 0 27.6 55.2c4 7.9 13.6 11.1 21.5 7.2s11.1-13.6 7.2-21.5l-112-224c-2.7-5.4-8.3-8.8-14.3-8.8zm0 51.8L310.1 272l-108.2 0L256 163.8z"/>
</svg>
