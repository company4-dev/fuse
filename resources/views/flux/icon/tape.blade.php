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
    <path style="opacity:0.4" d="M32 256a192 192 0 1 0 384 0A192 192 0 1 0 32 256zm288 0a96 96 0 1 1 -192 0 96 96 0 1 1 192 0z"/><path class="fa-primary" d="M224 64a192 192 0 1 1 0 384 192 192 0 1 1 0-384zM339.4 448C404.5 408.8 448 337.5 448 256C448 132.3 347.7 32 224 32S0 132.3 0 256S100.3 480 224 480l336 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-220.6 0zM224 192a64 64 0 1 1 0 128 64 64 0 1 1 0-128zm0 160a96 96 0 1 0 0-192 96 96 0 1 0 0 192z"/>
</svg>
