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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm112-96c0-8.8 7.2-16 16-16s16 7.2 16 16l0 128c0 44.2 35.8 80 80 80s80-35.8 80-80l0-128c0-8.8 7.2-16 16-16s16 7.2 16 16l0 128c0 61.9-50.1 112-112 112s-112-50.1-112-112l0-128z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM176 160c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 128c0 61.9 50.1 112 112 112s112-50.1 112-112l0-128c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 128c0 44.2-35.8 80-80 80s-80-35.8-80-80l0-128z"/>
</svg>
