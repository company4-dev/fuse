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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M48 32C21.5 32 0 53.5 0 80L0 248 0 464c0 8.8 7.2 16 16 16s16-7.2 16-16l0-192 208 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L32 240 32 80c0-8.8 7.2-16 16-16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L48 32z"/>
</svg>
