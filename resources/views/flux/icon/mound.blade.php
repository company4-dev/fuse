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
    <path style="opacity:0.4" d="M63.3 384l449.4 0L404.1 195.2C380.2 153.6 335.9 128 288 128s-92.2 25.6-116.1 67.2L63.3 384z"/><path class="fa-primary" d="M512.7 384L63.3 384 171.9 195.2C195.8 153.6 240.1 128 288 128s92.2 25.6 116.1 67.2L512.7 384zM288 96c-59.4 0-114.2 31.7-143.9 83.2L35.6 368c-12.3 21.3 3.1 48 27.7 48l449.4 0c24.6 0 40-26.6 27.7-48L431.9 179.2C402.2 127.7 347.4 96 288 96z"/>
</svg>
