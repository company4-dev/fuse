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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M379.3 363.3c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6L457.4 240 80 240c-26.5 0-48 21.5-48 48l0 176c0 8.8-7.2 16-16 16s-16-7.2-16-16L0 288c0-44.2 35.8-80 80-80l377.4 0L356.7 107.3c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0l128 128c6.2 6.2 6.2 16.4 0 22.6l-128 128z"/>
</svg>
