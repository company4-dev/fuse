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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M363.3 219.3l-128 128c-6.2 6.2-16.4 6.2-22.6 0l-128-128c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L208 297.4 208 192l0-144c0-8.8 7.2-16 16-16s16 7.2 16 16l0 144 0 105.4L340.7 196.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6zM32 424a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm384 0a24 24 0 1 1 0 48 24 24 0 1 1 0-48zM104 448a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm120-24a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm72 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/>
</svg>
