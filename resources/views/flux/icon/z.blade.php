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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M0 48c0-8.8 7.2-16 16-16l352 0c6.2 0 11.9 3.6 14.5 9.3s1.7 12.3-2.3 17.1L50.5 448 368 448c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 480c-6.2 0-11.9-3.6-14.5-9.3s-1.7-12.3 2.3-17.1L333.5 64 16 64C7.2 64 0 56.8 0 48z"/>
</svg>
