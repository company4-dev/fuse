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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M356.9 120.3c-74.4-75-194.9-75-269.3 0s-74.4 196.5 0 271.4s194.9 75 269.3 0c6.2-6.3 16.3-6.3 22.5 0s6.2 16.4 0 22.7c-86.8 87.5-227.5 87.5-314.4 0s-86.8-229.4 0-316.9s227.5-87.5 314.4 0c6.2 6.3 6.2 16.4 0 22.7s-16.3 6.3-22.5 0z"/>
</svg>
