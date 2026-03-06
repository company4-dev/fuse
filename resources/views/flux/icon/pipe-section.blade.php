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
    <path style="opacity:0.4" d="M32 160l0 192 576 0 0-192-352 0L32 160z"/><path class="fa-primary" d="M32 112c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 32L0 368l0 32c0 8.8 7.2 16 16 16s16-7.2 16-16l0-16 576 0 0 16c0 8.8 7.2 16 16 16s16-7.2 16-16l0-32 0-224 0-32c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 16-352 0L32 128l0-16zM608 352L32 352l0-192 224 0 352 0 0 192z"/>
</svg>
