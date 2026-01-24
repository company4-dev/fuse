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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M16 32C7.2 32 0 24.8 0 16S7.2 0 16 0L128 0c44.2 0 80 35.8 80 80l0 377.4L308.7 356.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6l-128 128c-6.2 6.2-16.4 6.2-22.6 0l-128-128c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L176 457.4 176 80c0-26.5-21.5-48-48-48L16 32z"/>
</svg>
