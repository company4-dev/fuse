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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm168.4-48a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM336 352a80 80 0 1 1 -160 0 80 80 0 1 1 160 0zm24.4-144a24 24 0 1 1 -48 0 24 24 0 1 1 48 0z"/><path class="fa-primary" d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm176.4-72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm136 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM208 352a48 48 0 1 0 96 0 48 48 0 1 0 -96 0zm48 80a80 80 0 1 1 0-160 80 80 0 1 1 0 160z"/>
</svg>
