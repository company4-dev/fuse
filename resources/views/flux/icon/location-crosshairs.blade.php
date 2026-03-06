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
    <path style="opacity:0.4" d="M416 256A160 160 0 1 1 96 256a160 160 0 1 1 320 0zm-256 0a96 96 0 1 0 192 0 96 96 0 1 0 -192 0zm160 0a64 64 0 1 1 -128 0 64 64 0 1 1 128 0z"/><path class="fa-primary" d="M256 0c8.8 0 16 7.2 16 16l0 48.7c93.3 7.7 167.6 82.1 175.3 175.3l48.7 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-48.7 0c-7.7 93.3-82.1 167.6-175.3 175.3l0 48.7c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48.7C146.7 439.6 72.4 365.3 64.7 272L16 272c-8.8 0-16-7.2-16-16s7.2-16 16-16l48.7 0C72.4 146.7 146.7 72.4 240 64.7L240 16c0-8.8 7.2-16 16-16zM96 256a160 160 0 1 0 320 0A160 160 0 1 0 96 256zm224 0a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zm-160 0a96 96 0 1 1 192 0 96 96 0 1 1 -192 0z"/>
</svg>
