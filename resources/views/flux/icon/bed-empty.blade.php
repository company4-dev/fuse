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
    <path style="opacity:0.4" d="M32 224l0 96 576 0 0-16c0-44.2-35.8-80-80-80L32 224zm0 128l0 32 576 0 0-32L32 352z"/><path class="fa-primary" d="M32 48c0-8.8-7.2-16-16-16S0 39.2 0 48L0 208 0 336l0 64 0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-48 576 0 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64 0-64 0-32c0-61.9-50.1-112-112-112L32 192 32 48zM608 320L32 320l0-96 496 0c44.2 0 80 35.8 80 80l0 16zM32 352l576 0 0 32L32 384l0-32z"/>
</svg>
