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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M304 32c-8.8 0-16 7.2-16 16l0 16-80 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l80 0 0 107.3c-23.5-26.6-57.8-43.3-96-43.3c-70.7 0-128 57.3-128 128s57.3 128 128 128c38.2 0 72.5-16.8 96-43.3l0 27.3c0 8.8 7.2 16 16 16s16-7.2 16-16l0-112 0-192 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-16c0-8.8-7.2-16-16-16zM96 288a96 96 0 1 1 192 0A96 96 0 1 1 96 288zM16 448c-8.8 0-16 7.2-16 16s7.2 16 16 16l352 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L16 448z"/>
</svg>
