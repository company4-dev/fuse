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
    <path style="opacity:0.4" d="M112 512c8.8 0 16-7.2 16-16s7.2-16 16-16l224 0c8.8 0 16 7.2 16 16s7.2 16 16 16l-288 0z"/><path class="fa-primary" d="M480 48c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 16-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 0 16c0 8.8 7.2 16 16 16s16-7.2 16-16l0-16 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-16zM64 272c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 16-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 0 16c0 8.8 7.2 16 16 16s16-7.2 16-16l0-16 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-16zm64 224c0-8.8 7.2-16 16-16l224 0c8.8 0 16 7.2 16 16s7.2 16 16 16s16-7.2 16-16c0-26.5-21.5-48-48-48l-224 0c-26.5 0-48 21.5-48 48c0 8.8 7.2 16 16 16s16-7.2 16-16z"/>
</svg>
