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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M16 352c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 0 96-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l64 0 240 0 240 0 64 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0 0-96 48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-64 0-240 0L80 352l-64 0zm80 32l208 0 0 96L96 480l0-96zm240 0l208 0 0 96-208 0 0-96z"/>
</svg>
