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
    <path style="opacity:0.4" d="M32 32l0 448 448 0 0-448L32 32z"/><path class="fa-primary" d="M480 32l0 448L32 480 32 32l448 0zM32 0L0 0 0 32 0 480l0 32 32 0 448 0 32 0 0-32 0-448 0-32L480 0 32 0z"/>
</svg>
