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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 320 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M216 32c-22.1 0-40 17.9-40 40l0 368c0 39.8-32.2 72-72 72s-72-32.2-72-72l0-24c0-8.8 7.2-16 16-16s16 7.2 16 16l0 24c0 22.1 17.9 40 40 40s40-17.9 40-40l0-368c0-39.8 32.2-72 72-72s72 32.2 72 72l0 24c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-24c0-22.1-17.9-40-40-40z"/>
</svg>
