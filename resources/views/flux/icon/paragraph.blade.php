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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 448 512" fill="currentColor">
    <path style="opacity:0.4" d="M64 192c0 70.7 57.3 128 128 128l64 0 0-256-64 0C121.3 64 64 121.3 64 192z"/><path class="fa-primary" d="M32 192c0-88.4 71.6-160 160-160l64 0 176 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-48 0 0 400c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-400-64 0 0 400c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-112-64 0c-88.4 0-160-71.6-160-160zM256 320l0-256-64 0C121.3 64 64 121.3 64 192s57.3 128 128 128l64 0z"/>
</svg>
