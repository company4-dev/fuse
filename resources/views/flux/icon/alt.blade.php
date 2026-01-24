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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 640 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M462 107.7c6.1-7.4 15.2-11.7 24.8-11.7L624 96c8.8 0 16-7.2 16-16s-7.2-16-16-16L486.7 64c-19.2 0-37.4 8.6-49.5 23.5L178 404.3c-6.1 7.4-15.2 11.7-24.8 11.7L16 416c-8.8 0-16 7.2-16 16s7.2 16 16 16l137.3 0c19.2 0 37.4-8.6 49.5-23.5L462 107.7zM432 416c-8.8 0-16 7.2-16 16s7.2 16 16 16l192 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-192 0z"/>
</svg>
