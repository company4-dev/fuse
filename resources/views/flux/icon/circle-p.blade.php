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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zM160 144c0-8.8 7.2-16 16-16l88 0c48.6 0 88 39.4 88 88s-39.4 88-88 88l-72 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-80 0-144zm32 16l0 112 72 0c30.9 0 56-25.1 56-56s-25.1-56-56-56l-72 0z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM176 128c-8.8 0-16 7.2-16 16l0 144 0 80c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64 72 0c48.6 0 88-39.4 88-88s-39.4-88-88-88l-88 0zm88 144l-72 0 0-112 72 0c30.9 0 56 25.1 56 56s-25.1 56-56 56z"/>
</svg>
