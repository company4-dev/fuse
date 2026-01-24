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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M10.5 33c6.3-2.3 13.4-.4 17.7 4.7L352 420.3 352 48c0-8.8 7.2-16 16-16s16 7.2 16 16l0 416c0 6.7-4.2 12.7-10.5 15s-13.4 .4-17.7-4.7L32 91.7 32 464c0 8.8-7.2 16-16 16s-16-7.2-16-16L0 48c0-6.7 4.2-12.7 10.5-15z"/>
</svg>
