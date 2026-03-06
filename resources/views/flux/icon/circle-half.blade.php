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
    <path style="opacity:0.4" d="M32 256c0 112.8 83.5 206.2 192 221.7l0-443.5C115.5 49.8 32 143.2 32 256z"/><path class="fa-primary" d="M224 34.3C115.5 49.8 32 143.2 32 256s83.5 206.2 192 221.7l0-443.5zM224.1 2C241.6-.2 256 14.3 256 32l0 448c0 17.7-14.4 32.2-31.9 30C97.8 494.3 0 386.6 0 256S97.8 17.7 224.1 2z"/>
</svg>
