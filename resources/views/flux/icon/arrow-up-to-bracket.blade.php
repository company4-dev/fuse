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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M363.3 292.7l-128-128c-6.2-6.2-16.4-6.2-22.6 0l-128 128c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L208 214.6 208 496c0 8.8 7.2 16 16 16s16-7.2 16-16l0-281.4L340.7 315.3c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6zM32 176l0-96c0-26.5 21.5-48 48-48l288 0c26.5 0 48 21.5 48 48l0 96c0 8.8 7.2 16 16 16s16-7.2 16-16l0-96c0-44.2-35.8-80-80-80L80 0C35.8 0 0 35.8 0 80l0 96c0 8.8 7.2 16 16 16s16-7.2 16-16z"/>
</svg>
