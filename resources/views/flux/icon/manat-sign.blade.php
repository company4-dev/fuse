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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 384 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M192 32c-8.8 0-16 7.2-16 16l0 48.7C77.4 104.8 0 187.3 0 288L0 464c0 8.8 7.2 16 16 16s16-7.2 16-16l0-176c0-83 63.1-151.2 144-159.2L176 464c0 8.8 7.2 16 16 16s16-7.2 16-16l0-335.2c80.9 8 144 76.2 144 159.2l0 176c0 8.8 7.2 16 16 16s16-7.2 16-16l0-176c0-100.7-77.4-183.2-176-191.3L208 48c0-8.8-7.2-16-16-16z"/>
</svg>
