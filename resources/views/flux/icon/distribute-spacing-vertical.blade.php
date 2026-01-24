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
    <path style="opacity:0.4" d="M128 208l0 96c0 8.8 7.2 16 16 16l224 0c8.8 0 16-7.2 16-16l0-96c0-8.8-7.2-16-16-16l-224 0c-8.8 0-16 7.2-16 16z"/><path class="fa-primary" d="M512 464c0-8.8-7.2-16-16-16L16 448c-8.8 0-16 7.2-16 16s7.2 16 16 16l480 0c8.8 0 16-7.2 16-16zM144 320c-8.8 0-16-7.2-16-16l0-96c0-8.8 7.2-16 16-16l224 0c8.8 0 16 7.2 16 16l0 96c0 8.8-7.2 16-16 16l-224 0zm224 32c26.5 0 48-21.5 48-48l0-96c0-26.5-21.5-48-48-48l-224 0c-26.5 0-48 21.5-48 48l0 96c0 26.5 21.5 48 48 48l224 0zM496 64c8.8 0 16-7.2 16-16s-7.2-16-16-16L16 32C7.2 32 0 39.2 0 48s7.2 16 16 16l480 0z"/>
</svg>
