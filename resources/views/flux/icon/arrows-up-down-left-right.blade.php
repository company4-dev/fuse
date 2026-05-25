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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M267.3 4.7c-6.2-6.2-16.4-6.2-22.6 0l-72 72c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L240 54.6 240 240 54.6 240l44.7-44.7c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0l-72 72c-6.2 6.2-6.2 16.4 0 22.6l72 72c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L54.6 272 240 272l0 185.4-44.7-44.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l72 72c6.2 6.2 16.4 6.2 22.6 0l72-72c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L272 457.4 272 272l185.4 0-44.7 44.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l72-72c6.2-6.2 6.2-16.4 0-22.6l-72-72c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L457.4 240 272 240l0-185.4 44.7 44.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-72-72z"/>
</svg>
