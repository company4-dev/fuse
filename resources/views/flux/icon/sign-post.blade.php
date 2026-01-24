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
    <path style="opacity:0.4" d="M64 96l0 128 353 0 53.3-64L417 96 64 96z"/><path class="fa-primary" d="M240 16c0-8.8 7.2-16 16-16s16 7.2 16 16l0 48 145 0c9.5 0 18.5 4.2 24.6 11.5l61.9 74.2c4.9 5.9 4.9 14.6 0 20.5l-61.9 74.2c-6.1 7.3-15.1 11.5-24.6 11.5l-145 0 0 240c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-240L64 256c-17.7 0-32-14.3-32-32L32 96c0-17.7 14.3-32 32-32l176 0 0-48zM470.3 160L417 96 64 96l0 128 353 0 53.3-64z"/>
</svg>
