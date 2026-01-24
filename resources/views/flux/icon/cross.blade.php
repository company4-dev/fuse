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
    <path style="opacity:0.4" d="M32 168l0 48c0 4.4 3.6 8 8 8l104 0c8.8 0 16 7.2 16 16l0 232c0 4.4 3.6 8 8 8l48 0c4.4 0 8-3.6 8-8l0-232c0-8.8 7.2-16 16-16l104 0c4.4 0 8-3.6 8-8l0-48c0-4.4-3.6-8-8-8l-104 0c-8.8 0-16-7.2-16-16l0-104c0-4.4-3.6-8-8-8l-48 0c-4.4 0-8 3.6-8 8l0 104c0 8.8-7.2 16-16 16L40 160c-4.4 0-8 3.6-8 8z"/><path class="fa-primary" d="M128 40c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 88 88 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-88 0 0 216c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-216-88 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l88 0 0-88zm40-8c-4.4 0-8 3.6-8 8l0 104c0 8.8-7.2 16-16 16L40 160c-4.4 0-8 3.6-8 8l0 48c0 4.4 3.6 8 8 8l104 0c8.8 0 16 7.2 16 16l0 232c0 4.4 3.6 8 8 8l48 0c4.4 0 8-3.6 8-8l0-232c0-8.8 7.2-16 16-16l104 0c4.4 0 8-3.6 8-8l0-48c0-4.4-3.6-8-8-8l-104 0c-8.8 0-16-7.2-16-16l0-104c0-4.4-3.6-8-8-8l-48 0z"/>
</svg>
