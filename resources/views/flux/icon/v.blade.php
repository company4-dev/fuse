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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M9.8 33.3c8.1-3.4 17.5 .4 21 8.5L192 422.9 353.3 41.8c3.4-8.1 12.8-11.9 21-8.5s11.9 12.8 8.5 21l-176 416c-2.5 5.9-8.3 9.8-14.7 9.8s-12.2-3.8-14.7-9.8L1.3 54.2c-3.4-8.1 .4-17.5 8.5-21z"/>
</svg>
