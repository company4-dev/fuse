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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 192 512" fill="currentColor">
    <path style="opacity:0.4" d="M64 96a32 32 0 1 0 64 0A32 32 0 1 0 64 96zm0 160a32 32 0 1 0 64 0 32 32 0 1 0 -64 0zm0 160a32 32 0 1 0 64 0 32 32 0 1 0 -64 0z"/><path class="fa-primary" d="M96 64a32 32 0 1 0 0 64 32 32 0 1 0 0-64zm0 96A64 64 0 1 1 96 32a64 64 0 1 1 0 128zm32 96a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm-96 0a64 64 0 1 1 128 0A64 64 0 1 1 32 256zm96 160a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm-96 0a64 64 0 1 1 128 0A64 64 0 1 1 32 416z"/>
</svg>
