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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M288 16c0 8.8 7.2 16 16 16l64 0c26.5 0 48 21.5 48 48s-21.5 48-48 48L16 128c-8.8 0-16 7.2-16 16s7.2 16 16 16l352 0c44.2 0 80-35.8 80-80s-35.8-80-80-80L304 0c-8.8 0-16 7.2-16 16zm64 384c0 8.8 7.2 16 16 16l56 0c48.6 0 88-39.4 88-88s-39.4-88-88-88L16 240c-8.8 0-16 7.2-16 16s7.2 16 16 16l408 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-56 0c-8.8 0-16 7.2-16 16zM112 512l64 0c44.2 0 80-35.8 80-80s-35.8-80-80-80L16 352c-8.8 0-16 7.2-16 16s7.2 16 16 16l160 0c26.5 0 48 21.5 48 48s-21.5 48-48 48l-64 0c-8.8 0-16 7.2-16 16s7.2 16 16 16z"/>
</svg>
