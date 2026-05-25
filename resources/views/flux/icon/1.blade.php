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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 256 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M144 48c0-5.9-3.2-11.3-8.5-14.1s-11.5-2.5-16.4 .8l-96 64c-7.4 4.9-9.3 14.8-4.4 22.2s14.8 9.3 22.2 4.4L112 77.9 112 448l-96 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l112 0 112 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-96 0 0-400z"/>
</svg>
