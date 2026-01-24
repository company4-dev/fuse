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
    <path style="opacity:0.4" d="M32 256c0 118.3 91.8 215.2 208 223.4l0-446.9C123.8 40.8 32 137.7 32 256z"/><path class="fa-primary" d="M240 479.4l0-446.9C123.8 40.8 32 137.7 32 256s91.8 215.2 208 223.4zM480 256c0-118.3-91.8-215.2-208-223.4l0 446.9C388.2 471.2 480 374.3 480 256zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
</svg>
