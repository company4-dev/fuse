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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 192 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M0 80C0 53.5 21.5 32 48 32l96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L48 64c-8.8 0-16 7.2-16 16l0 352c0 8.8 7.2 16 16 16l96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-96 0c-26.5 0-48-21.5-48-48L0 80z"/>
</svg>
