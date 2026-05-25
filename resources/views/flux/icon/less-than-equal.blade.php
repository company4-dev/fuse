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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M406.1 62.8c8.2-3.3 12.1-12.7 8.8-20.9s-12.7-12.1-20.9-8.8l-352 144c-6 2.5-9.9 8.3-9.9 14.8s3.9 12.3 9.9 14.8l352 144c8.2 3.3 17.5-.6 20.9-8.7s-.6-17.5-8.8-20.9L90.3 192 406.1 62.8zM16 448c-8.8 0-16 7.2-16 16s7.2 16 16 16l416 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L16 448z"/>
</svg>
