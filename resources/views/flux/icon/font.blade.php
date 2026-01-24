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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M238.7 41.8c-2.5-5.9-8.3-9.8-14.7-9.8s-12.2 3.8-14.7 9.8L37.4 448 16 448c-8.8 0-16 7.2-16 16s7.2 16 16 16l80 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-23.9 0 40.6-96 222.5 0 40.6 96L352 448c-8.8 0-16 7.2-16 16s7.2 16 16 16l80 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-21.4 0L238.7 41.8zm83 278.2l-195.4 0L224 89.1 321.7 320z"/>
</svg>
