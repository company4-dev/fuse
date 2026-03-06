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
    <path style="opacity:0.4" d="M96 206.7L288 37.3 480 206.7 480 432c0 26.5-21.5 48-48 48l-288 0c-26.5 0-48-21.5-48-48l0-225.3z"/><path class="fa-primary" d="M277.4 4c6-5.3 15.1-5.3 21.2 0l272 240c6.6 5.8 7.3 16 1.4 22.6s-16 7.3-22.6 1.4L512 235l0 197c0 44.2-35.8 80-80 80l-288 0c-44.2 0-80-35.8-80-80l0-197L26.6 268C20 273.8 9.8 273.2 4 266.6S-1.2 249.8 5.4 244L277.4 4zM96 206.7L96 432c0 26.5 21.5 48 48 48l288 0c26.5 0 48-21.5 48-48l0-225.3L288 37.3 96 206.7z"/>
</svg>
