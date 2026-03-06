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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 320 512" fill="currentColor">
    <path style="opacity:0.4" d="M32 256a128 128 0 1 0 256 0A128 128 0 1 0 32 256z"/><path class="fa-primary" d="M288 256A128 128 0 1 0 32 256a128 128 0 1 0 256 0zM0 256a160 160 0 1 1 320 0A160 160 0 1 1 0 256z"/>
</svg>
