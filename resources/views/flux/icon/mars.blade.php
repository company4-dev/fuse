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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 448 512" fill="currentColor">
    <path style="opacity:0.4" d="M32 304a144 144 0 1 0 288 0A144 144 0 1 0 32 304z"/><path class="fa-primary" d="M304 32c-8.8 0-16 7.2-16 16s7.2 16 16 16l89.4 0L288.6 168.7C258.1 143.3 218.8 128 176 128C78.8 128 0 206.8 0 304s78.8 176 176 176s176-78.8 176-176c0-42.8-15.3-82.1-40.7-112.6L416 86.6l0 89.4c0 8.8 7.2 16 16 16s16-7.2 16-16l0-128c0-8.8-7.2-16-16-16L304 32zM32 304a144 144 0 1 1 288 0A144 144 0 1 1 32 304z"/>
</svg>
