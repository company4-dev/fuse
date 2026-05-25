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
    <path style="opacity:0.4" d="M64 192c0-88.4 71.6-160 160-160s160 71.6 160 160l0 256L64 448l0-256z"/><path class="fa-primary" d="M384 192l0 256 32 0 0-256C416 86 330 0 224 0S32 86 32 192l0 256 32 0 0-256c0-88.4 71.6-160 160-160s160 71.6 160 160zM16 480c-8.8 0-16 7.2-16 16s7.2 16 16 16l416 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L16 480z"/>
</svg>
