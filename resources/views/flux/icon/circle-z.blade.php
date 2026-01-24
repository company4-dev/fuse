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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zM160 144c0-8.8 7.2-16 16-16l160 0c6 0 11.5 3.3 14.2 8.7s2.3 11.7-1.2 16.6L207.1 352 336 352c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-6 0-11.5-3.4-14.2-8.7s-2.3-11.7 1.2-16.6L304.9 160 176 160c-8.8 0-16-7.2-16-16z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM176 128c-8.8 0-16 7.2-16 16s7.2 16 16 16l128.9 0L163 358.7c-3.5 4.9-3.9 11.3-1.2 16.6s8.2 8.7 14.2 8.7l160 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-128.9 0L349 153.3c3.5-4.9 3.9-11.3 1.2-16.6s-8.2-8.7-14.2-8.7l-160 0z"/>
</svg>
