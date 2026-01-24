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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M1.3 41.6C3.9 35.8 9.6 32 16 32l328 0c22.1 0 40 17.9 40 40l0 72c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-72c0-4.4-3.6-8-8-8L52.5 64 219.8 245.1c5.7 6.1 5.7 15.6 0 21.7L52.5 448 344 448c4.4 0 8-3.6 8-8l0-72c0-8.8 7.2-16 16-16s16 7.2 16 16l0 72c0 22.1-17.9 40-40 40L16 480c-6.4 0-12.1-3.8-14.7-9.6s-1.4-12.6 2.9-17.3L186.2 256 4.2 58.9C-.1 54.2-1.2 47.4 1.3 41.6z"/>
</svg>
