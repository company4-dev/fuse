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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm136-80a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zm96-64a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zm0 96a24 24 0 1 1 -48 0 24 24 0 1 1 48 0z"/><path class="fa-primary" d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm240-72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm-120-8a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM240 88a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
</svg>
