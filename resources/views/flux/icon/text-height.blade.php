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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 576 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M491.3 36.7c-6.2-6.2-16.4-6.2-22.6 0l-80 80c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L464 86.6l0 338.7-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l80 80c6.2 6.2 16.4 6.2 22.6 0l80-80c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L496 425.4l0-338.7 52.7 52.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-80-80zM32 32C14.3 32 0 46.3 0 64l0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64 112 0 0 384-64 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l160 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-64 0 0-384 112 0 0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64c0-17.7-14.3-32-32-32L32 32z"/>
</svg>
