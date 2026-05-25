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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M0 64C0 46.3 14.3 32 32 32l384 0c17.7 0 32 14.3 32 32l0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48L240 64l0 384 64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0 0-384L32 64l0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16L0 64z"/>
</svg>
