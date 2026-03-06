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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm133.5-90.5c50-50 131-50 181 0c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0c-37.5-37.5-98.3-37.5-135.8 0s-37.5 98.3 0 135.8s98.3 37.5 135.8 0c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6c-50 50-131 50-181 0s-50-131 0-181z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm67.9-188.1c-37.5 37.5-98.3 37.5-135.8 0s-37.5-98.3 0-135.8s98.3-37.5 135.8 0c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6c-50-50-131-50-181 0s-50 131 0 181s131 50 181 0c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0z"/>
</svg>
