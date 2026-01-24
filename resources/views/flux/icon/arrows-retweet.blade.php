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
    <path style="opacity:0.4" d="M144 118.6l60.7 60.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L166.6 96 304 96c-8.8 0-16 7.2-16 16s7.2 16 16 16l144 0c26.5 0 48 21.5 48 48l0 217.4-60.7-60.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L473.4 416 336 416c8.8 0 16-7.2 16-16s-7.2-16-16-16l-144 0c-26.5 0-48-21.5-48-48l0-217.4z"/><path class="fa-primary" d="M116.7 68.7c6.2-6.2 16.4-6.2 22.6 0l88 88c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0L144 118.6 144 336c0 26.5 21.5 48 48 48l144 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-144 0c-44.2 0-80-35.8-80-80l0-217.4L51.3 179.3c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l88-88zM528 393.4l60.7-60.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6l-88 88c-6.2 6.2-16.4 6.2-22.6 0l-88-88c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L496 393.4 496 176c0-26.5-21.5-48-48-48l-144 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l144 0c44.2 0 80 35.8 80 80l0 217.4z"/>
</svg>
