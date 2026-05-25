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
    <path style="opacity:0.4" d="M64 80l0 272 256 0 256 0 0-272c0-8.8-7.2-16-16-16L432 64l0 64 16 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0-32 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l16 0 0-64L240 64l0 64 16 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0-32 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l16 0 0-64L80 64c-8.8 0-16 7.2-16 16z"/><path class="fa-primary" d="M432 16c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 16L240 32l0-16c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 16L80 32C53.5 32 32 53.5 32 80l0 272-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 32 0 240 0 0 104c0 8.8 7.2 16 16 16s16-7.2 16-16l0-104 240 0 32 0 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-272c0-26.5-21.5-48-48-48L432 32l0-16zM320 352L64 352 64 80c0-8.8 7.2-16 16-16l128 0 0 64-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l32 0 32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-64 160 0 0 64-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l32 0 32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-64 128 0c8.8 0 16 7.2 16 16l0 272-256 0z"/>
</svg>
