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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M32 144c-8.8 0-16 7.2-16 16s7.2 16 16 16l384 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L32 144zm0 192c-8.8 0-16 7.2-16 16s7.2 16 16 16l384 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L32 336z"/>
</svg>
