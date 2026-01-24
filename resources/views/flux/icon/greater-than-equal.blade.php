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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M41.9 62.8c-8.2-3.3-12.1-12.7-8.8-20.9s12.7-12.1 20.9-8.8l352 144c6 2.5 9.9 8.3 9.9 14.8s-3.9 12.3-9.9 14.8l-352 144c-8.2 3.3-17.5-.6-20.9-8.8s.6-17.5 8.8-20.9L357.7 192 41.9 62.8zM432 448c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 480c-8.8 0-16-7.2-16-16s7.2-16 16-16l416 0z"/>
</svg>
