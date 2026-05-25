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
    <path style="opacity:0.4" d="M32 272c0-26.5 21.5-48 48-48l288 0c26.5 0 48 21.5 48 48l0 160c0 26.5-21.5 48-48 48L80 480c-26.5 0-48-21.5-48-48l0-160z"/><path class="fa-primary" d="M128 128l0 64 192 0 0-64c0-53-43-96-96-96s-96 43-96 96zM96 192l0-64C96 57.3 153.3 0 224 0s128 57.3 128 128l0 64 16 0c44.2 0 80 35.8 80 80l0 160c0 44.2-35.8 80-80 80L80 512c-44.2 0-80-35.8-80-80L0 272c0-44.2 35.8-80 80-80l16 0zM32 272l0 160c0 26.5 21.5 48 48 48l288 0c26.5 0 48-21.5 48-48l0-160c0-26.5-21.5-48-48-48L80 224c-26.5 0-48 21.5-48 48z"/>
</svg>
