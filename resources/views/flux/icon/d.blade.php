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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M48 64c-8.8 0-16 7.2-16 16l0 352c0 8.8 7.2 16 16 16l112 0c106 0 192-86 192-192s-86-192-192-192L48 64zM0 80C0 53.5 21.5 32 48 32l112 0c123.7 0 224 100.3 224 224s-100.3 224-224 224L48 480c-26.5 0-48-21.5-48-48L0 80z"/>
</svg>
