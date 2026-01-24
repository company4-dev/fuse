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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm128-80c0-8.8 7.2-16 16-16l136 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-97.4 0L347.3 324.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0L192 214.6 192 320c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-144z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm56-352l-136 0c-8.8 0-16 7.2-16 16l0 144c0 8.8 7.2 16 16 16s16-7.2 16-16l0-105.4L324.7 347.3c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L214.6 192l97.4 0c8.8 0 16-7.2 16-16s-7.2-16-16-16z"/>
</svg>
