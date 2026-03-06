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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 512 512" fill="currentColor">
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zM160 144c0-8.8 7.2-16 16-16l160 0c5.7 0 11 3 13.8 8s2.9 11 .1 16l-128 224c-4.4 7.7-14.2 10.3-21.8 6s-10.3-14.2-6-21.8L308.4 160 176 160c-8.8 0-16-7.2-16-16z"/><path class="fa-primary" d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM176 128c-8.8 0-16 7.2-16 16s7.2 16 16 16l132.4 0L194.1 360.1c-4.4 7.7-1.7 17.4 6 21.8s17.4 1.7 21.8-6l128-224c2.8-5 2.8-11-.1-16s-8.1-8-13.8-8l-160 0z"/>
</svg>
