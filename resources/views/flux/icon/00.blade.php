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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M144 32C64.5 32 0 96.5 0 176L0 336c0 79.5 64.5 144 144 144s144-64.5 144-144l0-160c0-79.5-64.5-144-144-144zM32 176C32 114.1 82.1 64 144 64s112 50.1 112 112l0 160c0 61.9-50.1 112-112 112S32 397.9 32 336l0-160zM496 32c-79.5 0-144 64.5-144 144l0 160c0 79.5 64.5 144 144 144s144-64.5 144-144l0-160c0-79.5-64.5-144-144-144zM384 176c0-61.9 50.1-112 112-112s112 50.1 112 112l0 160c0 61.9-50.1 112-112 112s-112-50.1-112-112l0-160z"/>
</svg>
