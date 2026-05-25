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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M336 416c8.8 0 16-7.2 16-16l0-224c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 185.4L59.3 100.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L297.4 384 112 384c-8.8 0-16 7.2-16 16s7.2 16 16 16l224 0z"/>
</svg>
