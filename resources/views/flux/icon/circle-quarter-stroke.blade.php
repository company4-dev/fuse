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
    <path style="opacity:0.4" d="M34.3 224L208 224c8.8 0 16-7.2 16-16l0-173.7C125.9 48.3 48.3 125.9 34.3 224z"/><path class="fa-primary" d="M480 256C480 132.3 379.7 32 256 32l0 176c0 26.5-21.5 48-48 48L32 256c0 123.7 100.3 224 224 224s224-100.3 224-224zM224 34.3C125.9 48.3 48.3 125.9 34.3 224L208 224c8.8 0 16-7.2 16-16l0-173.7zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
</svg>
