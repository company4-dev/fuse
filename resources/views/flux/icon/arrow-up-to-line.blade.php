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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M16 32C7.2 32 0 39.2 0 48s7.2 16 16 16l352 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L16 32zM203.3 132.7c-6.2-6.2-16.4-6.2-22.6 0l-128 128c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L176 182.6 176 288l0 176c0 8.8 7.2 16 16 16s16-7.2 16-16l0-176 0-105.4L308.7 283.3c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-128-128z"/>
</svg>
