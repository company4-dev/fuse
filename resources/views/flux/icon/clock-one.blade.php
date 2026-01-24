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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zM240 112c0-8.8 7.2-16 16-16s16 7.2 16 16l0 91.2 34.7-52c4.9-7.4 14.8-9.3 22.2-4.4s9.3 14.8 4.4 22.2l-64 96c-3.9 5.9-11.2 8.5-17.9 6.4s-11.4-8.3-11.4-15.3l0-144z"/><path class="fa-primary" d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM272 112l0 91.2 34.7-52c4.9-7.4 14.8-9.3 22.2-4.4s9.3 14.8 4.4 22.2l-64 96c-3.9 5.9-11.2 8.5-17.9 6.4s-11.4-8.3-11.4-15.3l0-144c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
</svg>
