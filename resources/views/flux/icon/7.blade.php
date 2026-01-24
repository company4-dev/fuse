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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 320 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M0 48c0-8.8 7.2-16 16-16l288 0c5.8 0 11.1 3.1 14 8.2s2.7 11.3-.3 16.2l-256 416c-4.6 7.5-14.5 9.9-22 5.2s-9.9-14.5-5.2-22L275.4 64 16 64C7.2 64 0 56.8 0 48z"/>
</svg>
