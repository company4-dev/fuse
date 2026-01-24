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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M322.4 32c-32.1 0-61.2 19.2-73.7 48.8L188.2 224 48 224c-8.8 0-16 7.2-16 16s7.2 16 16 16l126.6 0L105.8 418.7C98.3 436.5 80.9 448 61.6 448L16 448c-8.8 0-16 7.2-16 16s7.2 16 16 16l45.6 0c32.1 0 61.2-19.2 73.7-48.8L209.4 256 336 256c8.8 0 16-7.2 16-16s-7.2-16-16-16l-113.1 0L278.2 93.3C285.7 75.5 303.1 64 322.4 64L368 64c8.8 0 16-7.2 16-16s-7.2-16-16-16l-45.6 0z"/>
</svg>
