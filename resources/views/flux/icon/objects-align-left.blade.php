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
    <path style="opacity:0.4" d="M160 112l0 64c0 8.8 7.2 16 16 16l288 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16L176 96c-8.8 0-16 7.2-16 16zm0 224l0 64c0 8.8 7.2 16 16 16l160 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-160 0c-8.8 0-16 7.2-16 16z"/><path class="fa-primary" d="M0 16C0 7.2 7.2 0 16 0s16 7.2 16 16l0 480c0 8.8-7.2 16-16 16s-16-7.2-16-16L0 16zM160 176c0 8.8 7.2 16 16 16l288 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16L176 96c-8.8 0-16 7.2-16 16l0 64zm-32-64c0-26.5 21.5-48 48-48l288 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-288 0c-26.5 0-48-21.5-48-48l0-64zm32 288c0 8.8 7.2 16 16 16l160 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-160 0c-8.8 0-16 7.2-16 16l0 64zm-32-64c0-26.5 21.5-48 48-48l160 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-160 0c-26.5 0-48-21.5-48-48l0-64z"/>
</svg>
