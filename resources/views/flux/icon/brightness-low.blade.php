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
    <path style="opacity:0.4" d="M192 256a64 64 0 1 0 128 0 64 64 0 1 0 -128 0z"/><path class="fa-primary" d="M280 80a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM256 192a64 64 0 1 1 0 128 64 64 0 1 1 0-128zm0 160a96 96 0 1 0 0-192 96 96 0 1 0 0 192zm0 104a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM432 280a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM56 256a24 24 0 1 0 48 0 24 24 0 1 0 -48 0zm96-128a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM408 384a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zm0-256a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM104 384a24 24 0 1 0 48 0 24 24 0 1 0 -48 0z"/>
</svg>
