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
    <path style="opacity:0.4" d="M32 352l0 32 576 0 0-32-336 0L32 352zM96 208a48 48 0 1 0 96 0 48 48 0 1 0 -96 0zm192-32l0 144 320 0 0-80c0-44.2-35.8-80-80-80l-224 0c-8.8 0-16 7.2-16 16z"/><path class="fa-primary" d="M32 48c0-8.8-7.2-16-16-16S0 39.2 0 48L0 336l0 64 0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-48 576 0 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64 0-64 0-96c0-61.9-50.1-112-112-112l-224 0c-26.5 0-48 21.5-48 48l0 144L32 320 32 48zM608 384L32 384l0-32 240 0 336 0 0 32zm0-144l0 80-320 0 0-144c0-8.8 7.2-16 16-16l224 0c44.2 0 80 35.8 80 80zM96 208a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm128 0A80 80 0 1 0 64 208a80 80 0 1 0 160 0z"/>
</svg>
