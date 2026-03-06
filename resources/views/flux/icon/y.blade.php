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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M28.9 38.5c-5.2-7.1-15.2-8.7-22.4-3.4S-2.1 50.3 3.1 57.5L176 293.2 176 464c0 8.8 7.2 16 16 16s16-7.2 16-16l0-170.8L380.9 57.5c5.2-7.1 3.7-17.1-3.4-22.4s-17.1-3.7-22.4 3.4L192 260.9 28.9 38.5z"/>
</svg>
