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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M234 19.5c-5.8-4.7-14.1-4.7-20 0L54 147.5c-6.9 5.5-8 15.6-2.5 22.5s15.6 8 22.5 2.5l150-120 150 120c6.9 5.5 17 4.4 22.5-2.5s4.4-17-2.5-22.5L234 19.5zm160 345c6.9-5.5 8-15.6 2.5-22.5s-15.6-8-22.5-2.5l-150 120L74 339.5c-6.9-5.5-17-4.4-22.5 2.5s-4.4 17 2.5 22.5l160 128c5.8 4.7 14.1 4.7 20 0l160-128z"/>
</svg>
