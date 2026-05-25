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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm416 0A192 192 0 1 1 64 256a192 192 0 1 1 384 0zM96 256a160 160 0 1 0 320 0A160 160 0 1 0 96 256zm144-80c0-8.8 7.2-16 16-16s16 7.2 16 16l0 160c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-160z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-416a160 160 0 1 1 0 320 160 160 0 1 1 0-320zm0 352a192 192 0 1 0 0-384 192 192 0 1 0 0 384zm16-272c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 160c0 8.8 7.2 16 16 16s16-7.2 16-16l0-160z"/>
</svg>
