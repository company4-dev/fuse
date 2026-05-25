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
    <path style="opacity:0.4" d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM146.7 183.1c-4.9 7.4-2.9 17.3 4.4 22.2l96 64c4.9 3.3 11.2 3.6 16.4 .8s8.5-8.2 8.5-14.1l0-144c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 114.1-71.1-47.4c-7.4-4.9-17.3-2.9-22.2 4.4z"/><path class="fa-primary" d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112l0 114.1-71.1-47.4c-7.4-4.9-17.3-2.9-22.2 4.4s-2.9 17.3 4.4 22.2l96 64c4.9 3.3 11.2 3.6 16.4 .8s8.5-8.2 8.5-14.1l0-144c0-8.8-7.2-16-16-16s-16 7.2-16 16z"/>
</svg>
