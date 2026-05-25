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
    <path style="opacity:0.4" d="M32 240a112 112 0 1 0 224 0A112 112 0 1 0 32 240zm352 0a112 112 0 1 0 224 0 112 112 0 1 0 -224 0z"/><path class="fa-primary" d="M144 352a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM288 240c0 45.2-20.9 85.6-53.5 112l171 0C372.9 325.6 352 285.2 352 240c0-79.5 64.5-144 144-144s144 64.5 144 144s-64.5 144-144 144l-352 0C64.5 384 0 319.5 0 240S64.5 96 144 96s144 64.5 144 144zM496 352a112 112 0 1 0 0-224 112 112 0 1 0 0 224z"/>
</svg>
