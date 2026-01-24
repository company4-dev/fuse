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
    <path style="opacity:0.4" d="M96 48l0 288c0 8.8 7.2 16 16 16l64 0c8.8 0 16-7.2 16-16l0-288c0-8.8-7.2-16-16-16l-64 0c-8.8 0-16 7.2-16 16zM320 176l0 160c0 8.8 7.2 16 16 16l64 0c8.8 0 16-7.2 16-16l0-160c0-8.8-7.2-16-16-16l-64 0c-8.8 0-16 7.2-16 16z"/><path class="fa-primary" d="M16 512c-8.8 0-16-7.2-16-16s7.2-16 16-16l480 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 512zM176 352c8.8 0 16-7.2 16-16l0-288c0-8.8-7.2-16-16-16l-64 0c-8.8 0-16 7.2-16 16l0 288c0 8.8 7.2 16 16 16l64 0zm-64 32c-26.5 0-48-21.5-48-48L64 48C64 21.5 85.5 0 112 0l64 0c26.5 0 48 21.5 48 48l0 288c0 26.5-21.5 48-48 48l-64 0zm288-32c8.8 0 16-7.2 16-16l0-160c0-8.8-7.2-16-16-16l-64 0c-8.8 0-16 7.2-16 16l0 160c0 8.8 7.2 16 16 16l64 0zm-64 32c-26.5 0-48-21.5-48-48l0-160c0-26.5 21.5-48 48-48l64 0c26.5 0 48 21.5 48 48l0 160c0 26.5-21.5 48-48 48l-64 0z"/>
</svg>
