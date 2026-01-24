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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm208 0c0-3.2 .9-6.2 2.7-8.9l64-96c4.9-7.4 14.8-9.3 22.2-4.4s9.3 14.8 4.4 22.2l-61.3 92L272 400c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-144z"/><path class="fa-primary" d="M32 256a224 224 0 1 1 448 0A224 224 0 1 1 32 256zm480 0A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM272 400l0-139.2 61.3-92c4.9-7.4 2.9-17.3-4.4-22.2s-17.3-2.9-22.2 4.4l-64 96c-1.8 2.6-2.7 5.7-2.7 8.9l0 144c0 8.8 7.2 16 16 16s16-7.2 16-16z"/>
</svg>
