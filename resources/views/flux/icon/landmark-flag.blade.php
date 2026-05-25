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
    <path style="opacity:0.4" d="M96 192l0 160 80 0 0-160-80 0zm112 0l0 160 96 0 0-160-96 0zm128 0l0 160 80 0 0-160-80 0z"/><path class="fa-primary" d="M272 32l0 32 64 0 0-32-64 0zm80 64l-80 0 0 32 192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L48 160c-8.8 0-16-7.2-16-16s7.2-16 16-16l192 0 0-32 0-32 0-40 0-8c0-8.8 7.2-16 16-16l8 0 8 0 80 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16zM48 368c0-8.8 7.2-16 16-16l0-160 32 0 0 160 80 0 0-160 32 0 0 160 96 0 0-160 32 0 0 160 80 0 0-160 32 0 0 160c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 384c-8.8 0-16-7.2-16-16zM24 432c0-8.8 7.2-16 16-16l432 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L40 448c-8.8 0-16-7.2-16-16zM0 496c0-8.8 7.2-16 16-16l480 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 512c-8.8 0-16-7.2-16-16z"/>
</svg>
