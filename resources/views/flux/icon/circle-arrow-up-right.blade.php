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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm132.7 68.7L297.4 192 200 192c-8.8 0-16-7.2-16-16s7.2-16 16-16l136 0c8.8 0 16 7.2 16 16l0 144c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-105.4L187.3 347.3c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6z"/><path class="fa-primary" d="M256 480a224 224 0 1 0 0-448 224 224 0 1 0 0 448zM256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM200 160l136 0c8.8 0 16 7.2 16 16l0 144c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-105.4L187.3 347.3c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6L297.4 192 200 192c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
</svg>
