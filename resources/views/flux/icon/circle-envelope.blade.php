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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm96-64c0-17.7 14.3-32 32-32l192 0c17.7 0 32 14.3 32 32l0 128c0 17.7-14.3 32-32 32l-192 0c-17.7 0-32-14.3-32-32l0-128z"/><path class="fa-primary" d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm160-96l192 0c17.7 0 32 14.3 32 32l0 128c0 17.7-14.3 32-32 32l-192 0c-17.7 0-32-14.3-32-32l0-128c0-17.7 14.3-32 32-32zm192 48.5l0-16.5-192 0 0 16.5 88.5 47.1c2.3 1.2 4.9 1.9 7.5 1.9s5.2-.6 7.5-1.9L352 208.5zm0 36.2l-73.4 39.1c-7 3.7-14.7 5.6-22.6 5.6s-15.6-1.9-22.6-5.6L160 244.8l0 75.2 192 0 0-75.2z"/>
</svg>
