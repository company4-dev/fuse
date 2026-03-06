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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M267.3 52.7c-6.2-6.2-16.4-6.2-22.6 0l-192 192c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L256 86.6 436.7 267.3c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-192-192zm192 384l-192-192c-6.2-6.2-16.4-6.2-22.6 0l-192 192c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L256 278.6 436.7 459.3c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6z"/>
</svg>
