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
    <path style="opacity:0.4" d="M64 128a64 64 0 1 0 128 0A64 64 0 1 0 64 128zm0 256a64 64 0 1 0 128 0A64 64 0 1 0 64 384zM320 128a64 64 0 1 0 128 0 64 64 0 1 0 -128 0zm0 256a64 64 0 1 0 128 0 64 64 0 1 0 -128 0z"/><path class="fa-primary" d="M128 192a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm96-64A96 96 0 1 1 32 128a96 96 0 1 1 192 0zM128 448a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm96-64A96 96 0 1 1 32 384a96 96 0 1 1 192 0zm96-256a64 64 0 1 0 128 0 64 64 0 1 0 -128 0zm64 96a96 96 0 1 1 0-192 96 96 0 1 1 0 192zm0 224a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm96-64a96 96 0 1 1 -192 0 96 96 0 1 1 192 0z"/>
</svg>
