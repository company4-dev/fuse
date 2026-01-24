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
    <path style="opacity:0.4" d="M32 192l0 128c0 17.7 14.3 32 32 32l512 0c17.7 0 32-14.3 32-32l0-128c0-17.7-14.3-32-32-32l-48 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-64 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-64 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-64 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-64 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-48 0c-17.7 0-32 14.3-32 32z"/><path class="fa-primary" d="M32 320c0 17.7 14.3 32 32 32l512 0c17.7 0 32-14.3 32-32l0-128c0-17.7-14.3-32-32-32l-48 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-64 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-64 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-64 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-64 0 0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64-48 0c-17.7 0-32 14.3-32 32l0 128zm32 64c-35.3 0-64-28.7-64-64L0 192c0-35.3 28.7-64 64-64l512 0c35.3 0 64 28.7 64 64l0 128c0 35.3-28.7 64-64 64L64 384z"/>
</svg>
