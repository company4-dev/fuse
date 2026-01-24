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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 384 512" fill="currentColor">
    <path style="opacity:0.4" d="M48 176a144 144 0 1 0 288 0A144 144 0 1 0 48 176z"/><path class="fa-primary" d="M48 176a144 144 0 1 1 288 0A144 144 0 1 1 48 176zM208 351.3c89.7-8.1 160-83.5 160-175.3C368 78.8 289.2 0 192 0S16 78.8 16 176c0 91.8 70.3 167.2 160 175.3l0 64.7-64 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l64 0 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-48 64 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-64 0 0-64.7z"/>
</svg>
