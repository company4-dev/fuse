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
    <path style="opacity:0.4" d="M0 208l0 96c0-8.8 7.2-16 16-16s16 7.2 16 16l0 112 112 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l224 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l112 0 0-112c0-8.8 7.2-16 16-16s16 7.2 16 16l0-96c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-112L368 96c-8.8 0-16-7.2-16-16s7.2-16 16-16L144 64c8.8 0 16 7.2 16 16s-7.2 16-16 16L32 96l0 112c0 8.8-7.2 16-16 16s-16-7.2-16-16z"/><path class="fa-primary" d="M144 64c8.8 0 16 7.2 16 16s-7.2 16-16 16L32 96l0 112c0 8.8-7.2 16-16 16s-16-7.2-16-16L0 80c0-8.8 7.2-16 16-16l128 0zM0 304c0-8.8 7.2-16 16-16s16 7.2 16 16l0 112 112 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 448c-8.8 0-16-7.2-16-16L0 304zM496 64c8.8 0 16 7.2 16 16l0 128c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-112L368 96c-8.8 0-16-7.2-16-16s7.2-16 16-16l128 0zM480 304c0-8.8 7.2-16 16-16s16 7.2 16 16l0 128c0 8.8-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l112 0 0-112z"/>
</svg>
