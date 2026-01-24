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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M104.7 32C82.2 32 64 50.2 64 72.7L64 288l-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 0 64-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-48 208 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L96 384l0-64 144 0c79.5 0 144-64.5 144-144s-64.5-144-144-144L104.7 32zM96 288L96 72.7c0-4.8 3.9-8.7 8.7-8.7L240 64c61.9 0 112 50.1 112 112s-50.1 112-112 112L96 288z"/>
</svg>
