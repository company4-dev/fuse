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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M11.3 32.7c6.7-2.1 14 .5 17.9 6.3L224 323.7 418.8 39c4-5.8 11.2-8.3 17.9-6.3S448 41 448 48l0 416c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-364.3L237.2 361c-3 4.4-7.9 7-13.2 7s-10.2-2.6-13.2-7L32 99.7 32 464c0 8.8-7.2 16-16 16s-16-7.2-16-16L0 48c0-7 4.6-13.2 11.3-15.3z"/>
</svg>
