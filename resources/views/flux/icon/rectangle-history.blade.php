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
    <path style="opacity:0.4" d="M32 192l0 256c0 17.7 14.3 32 32 32l384 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32L64 160c-17.7 0-32 14.3-32 32z"/><path class="fa-primary" d="M480 192c0-17.7-14.3-32-32-32L64 160c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l384 0c17.7 0 32-14.3 32-32l0-256zm-32-64c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 192c0-35.3 28.7-64 64-64l384 0zm0-64c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 96c-8.8 0-16-7.2-16-16s7.2-16 16-16l384 0zM400 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L112 32c-8.8 0-16-7.2-16-16s7.2-16 16-16L400 0z"/>
</svg>
