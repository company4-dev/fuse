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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M292 5.5c5.8-6.7 15.9-7.3 22.6-1.5l128 112c3.5 3 5.5 7.4 5.5 12s-2 9-5.5 12l-128 112c-6.7 5.8-16.8 5.1-22.6-1.5s-5.1-16.8 1.5-22.6l96-84L112 144c-44.2 0-80 35.8-80 80l0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48c0-61.9 50.1-112 112-112l277.4 0-96-84c-6.6-5.8-7.3-15.9-1.5-22.6zm-96 256c5.8-6.6 15.9-7.3 22.6-1.5l128 112c3.5 3 5.5 7.4 5.5 12s-2 9-5.5 12l-128 112c-6.7 5.8-16.8 5.1-22.6-1.5s-5.1-16.8 1.5-22.6l96-84L80 400c-26.5 0-48 21.5-48 48l0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48c0-44.2 35.8-80 80-80l213.4 0-96-84c-6.7-5.8-7.3-15.9-1.5-22.6z"/>
</svg>
