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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 640 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M32 16C32 7.2 24.8 0 16 0S0 7.2 0 16L0 176 0 432l0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-48 576 0 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64 0-256 0-160c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 144L32 160 32 16zm0 176l576 0 0 224L32 416l0-224z"/>
</svg>
