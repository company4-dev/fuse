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
    <path style="opacity:0.4" d="M0 176c0 8.8 7.2 16 16 16l128 0c8.8 0 16-7.2 16-16l0-128c0-8.8-7.2-16-16-16l160 0c-8.8 0-16 7.2-16 16l0 128c0 8.8 7.2 16 16 16l128 0c8.8 0 16-7.2 16-16l0 160c0-8.8-7.2-16-16-16l-128 0c-8.8 0-16 7.2-16 16l0 128c0 8.8 7.2 16 16 16l-160 0c8.8 0 16-7.2 16-16l0-128c0-8.8-7.2-16-16-16L16 320c-8.8 0-16 7.2-16 16L0 176z"/><path class="fa-primary" d="M160 48c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 112L16 160c-8.8 0-16 7.2-16 16s7.2 16 16 16l128 0c8.8 0 16-7.2 16-16l0-128zM16 320c-8.8 0-16 7.2-16 16s7.2 16 16 16l112 0 0 112c0 8.8 7.2 16 16 16s16-7.2 16-16l0-128c0-8.8-7.2-16-16-16L16 320zM320 48c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 128c0 8.8 7.2 16 16 16l128 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-112 0 0-112zM304 320c-8.8 0-16 7.2-16 16l0 128c0 8.8 7.2 16 16 16s16-7.2 16-16l0-112 112 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-128 0z"/>
</svg>
