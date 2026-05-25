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
    <path style="opacity:0.4" d="M32 176l0 240c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-240c0-8.8-7.2-16-16-16l-80 0 0 80c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-80-128 0 0 80c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-80-80 0c-8.8 0-16 7.2-16 16z"/><path class="fa-primary" d="M160 96l0 32 128 0 0-32c0-35.3-28.7-64-64-64s-64 28.7-64 64zm-32 64l-80 0c-8.8 0-16 7.2-16 16l0 240c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-240c0-8.8-7.2-16-16-16l-80 0 0 80c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-80-128 0 0 80c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-80zm0-32l0-32c0-53 43-96 96-96s96 43 96 96l0 32 80 0c26.5 0 48 21.5 48 48l0 240c0 53-43 96-96 96L96 512c-53 0-96-43-96-96L0 176c0-26.5 21.5-48 48-48l80 0z"/>
</svg>
