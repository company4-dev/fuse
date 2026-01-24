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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M377.1 34.8c7.3 5 9.1 15 4 22.3L321 144l95 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-117.2 0L188.1 336 416 336c8.8 0 16 7.2 16 16s-7.2 16-16 16l-250.1 0L93.2 473.1c-5 7.3-15 9.1-22.3 4s-9.1-15-4-22.3L127 368l-95 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l117.2 0L259.9 176 32 176c-8.8 0-16-7.2-16-16s7.2-16 16-16l250.1 0L354.8 38.9c5-7.3 15-9.1 22.3-4z"/>
</svg>
