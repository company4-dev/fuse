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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M80 32c8.8 0 16 7.2 16 16l0 174.4L325.9 35.6c6.9-5.6 16.9-4.5 22.5 2.3s4.5 16.9-2.3 22.5L125.1 240 368 240c8.8 0 16 7.2 16 16s-7.2 16-16 16l-242.9 0 221 179.6c6.9 5.6 7.9 15.6 2.3 22.5s-15.7 7.9-22.5 2.3L96 289.6 96 465c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-193-48 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l48 0L64 48c0-8.8 7.2-16 16-16z"/>
</svg>
