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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm128-97.2c0-17 13.8-30.8 30.8-30.8l65.2 0c70.7 0 128 57.3 128 128s-57.3 128-128 128l-65.2 0c-17 0-30.8-13.8-30.8-30.8l0-194.5zm32 1.2l0 192 64 0c53 0 96-43 96-96s-43-96-96-96l-64 0z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-160l-64 0 0-192 64 0c53 0 96 43 96 96s-43 96-96 96zM190.8 128c-17 0-30.8 13.8-30.8 30.8l0 194.5c0 17 13.8 30.8 30.8 30.8l65.2 0c70.7 0 128-57.3 128-128s-57.3-128-128-128l-65.2 0z"/>
</svg>
