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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 576 512" fill="currentColor">
    <path style="opacity:0.4" d="M161 272l127 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-127 0c7.9 63.1 61.7 112 127 112c70.7 0 128-57.3 128-128s-57.3-128-128-128c-65.3 0-119.1 48.9-127 112z"/><path class="fa-primary" d="M288 56a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm0 360c-65.3 0-119.1-48.9-127-112l127 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-127 0c7.9-63.1 61.7-112 127-112c70.7 0 128 57.3 128 128s-57.3 128-128 128zM128 288a160 160 0 1 0 320 0 160 160 0 1 0 -320 0zm440 0a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM32 312a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM120 96A24 24 0 1 0 72 96a24 24 0 1 0 48 0zm360 24a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM120 480a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zm360 24a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/>
</svg>
