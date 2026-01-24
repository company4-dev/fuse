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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M164.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l128-128c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L214.6 240 496 240c8.8 0 16 7.2 16 16s-7.2 16-16 16l-281.4 0L315.3 372.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-128-128zM176 448c8.8 0 16 7.2 16 16s-7.2 16-16 16l-96 0c-44.2 0-80-35.8-80-80L0 112C0 67.8 35.8 32 80 32l96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L80 64c-26.5 0-48 21.5-48 48l0 288c0 26.5 21.5 48 48 48l96 0z"/>
</svg>
