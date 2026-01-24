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
    <path style="opacity:0.4" d="M192 128A64 64 0 1 1 64 128a64 64 0 1 1 128 0zm0 256A64 64 0 1 1 64 384a64 64 0 1 1 128 0zM448 128a64 64 0 1 1 -128 0 64 64 0 1 1 128 0z"/><path class="fa-primary" d="M64 128a64 64 0 1 0 128 0A64 64 0 1 0 64 128zm64 96a96 96 0 1 1 0-192 96 96 0 1 1 0 192zM64 384a64 64 0 1 0 128 0A64 64 0 1 0 64 384zm64 96a96 96 0 1 1 0-192 96 96 0 1 1 0 192zM384 192a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm96-64a96 96 0 1 1 -192 0 96 96 0 1 1 192 0zM384 272c8.8 0 16 7.2 16 16l0 80 80 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-80 0 0 80c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-80-80 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l80 0 0-80c0-8.8 7.2-16 16-16z"/>
</svg>
