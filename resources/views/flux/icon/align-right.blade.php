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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M432 48c8.8 0 16 7.2 16 16s-7.2 16-16 16L176 80c-8.8 0-16-7.2-16-16s7.2-16 16-16l256 0zm0 128c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 208c-8.8 0-16-7.2-16-16s7.2-16 16-16l416 0zm16 144c0 8.8-7.2 16-16 16l-256 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l256 0c8.8 0 16 7.2 16 16zM432 432c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 464c-8.8 0-16-7.2-16-16s7.2-16 16-16l416 0z"/>
</svg>
