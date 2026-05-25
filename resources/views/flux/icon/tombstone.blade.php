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
    <path style="opacity:0.4" d="M64 192c0-88.4 71.6-160 160-160s160 71.6 160 160l0 256L64 448l0-256zm64 32c0 8.8 7.2 16 16 16l64 0 0 128c0 8.8 7.2 16 16 16s16-7.2 16-16l0-128 64 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-64 0 0-64c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 64-64 0c-8.8 0-16 7.2-16 16z"/><path class="fa-primary" d="M384 448l0-256c0-88.4-71.6-160-160-160S64 103.6 64 192l0 256-32 0 0-256C32 86 118 0 224 0S416 86 416 192l0 256-32 0zM0 496c0-8.8 7.2-16 16-16l416 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 512c-8.8 0-16-7.2-16-16zM240 144l0 64 64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0 0 128c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-128-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0 0-64c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
</svg>
