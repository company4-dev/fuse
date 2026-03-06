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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M640 80l0 352c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-352c0-8.8 7.2-16 16-16s16 7.2 16 16zM507.3 244.7c6.2 6.2 6.2 16.4 0 22.6l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6L457.4 272 16 272c-8.8 0-16-7.2-16-16s7.2-16 16-16l441.4 0L340.7 123.3c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0l144 144z"/>
</svg>
