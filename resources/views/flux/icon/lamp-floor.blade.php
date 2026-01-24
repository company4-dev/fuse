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
    <path style="opacity:0.4" d="M32 192l320 0L288 32 96 32 32 192z"/><path class="fa-primary" d="M96 32L32 192l320 0L288 32 96 32zM66.3 20.1C71.1 8 82.9 0 96 0L288 0c13.1 0 24.9 8 29.7 20.1l64 160c3.9 9.9 2.7 21-3.2 29.8s-15.9 14.1-26.5 14.1L32 224c-10.6 0-20.5-5.3-26.5-14.1s-7.2-20-3.2-29.8l64-160zM80 480l96 0 0-224 32 0 0 224 96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-112 0L80 512c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
</svg>
