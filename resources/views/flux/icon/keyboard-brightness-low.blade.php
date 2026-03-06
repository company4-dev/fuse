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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M320 184a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM208 384c-8.8 0-16 7.2-16 16s7.2 16 16 16l224 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-224 0zM184 224a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zm296 24a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm88 136a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM96 408a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/>
</svg>
