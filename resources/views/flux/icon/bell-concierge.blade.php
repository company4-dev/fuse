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
    <path style="opacity:0.4" d="M64 368c0-106 86-192 192-192s192 86 192 192l0 16L64 384l0-16z"/><path class="fa-primary" d="M208 64c-8.8 0-16 7.2-16 16s7.2 16 16 16l32 0 0 48.6C123.8 152.8 32 249.7 32 368l0 16 32 0 0-16c0-106 86-192 192-192s192 86 192 192l0 16 32 0 0-16c0-118.3-91.8-215.2-208-223.4L272 96l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0-48 0zM16 416c-8.8 0-16 7.2-16 16s7.2 16 16 16l480 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L16 416z"/>
</svg>
