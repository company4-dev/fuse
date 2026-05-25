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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M336 32c-8.8 0-16 7.2-16 16s7.2 16 16 16l89.4 0L256 233.4 86.6 64 176 64c8.8 0 16-7.2 16-16s-7.2-16-16-16L48 32c-8.8 0-16 7.2-16 16l0 128c0 8.8 7.2 16 16 16s16-7.2 16-16l0-89.4L233.4 256 64 425.4 64 336c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 128c0 8.8 7.2 16 16 16l128 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-89.4 0L256 278.6 425.4 448 336 448c-8.8 0-16 7.2-16 16s7.2 16 16 16l128 0c8.8 0 16-7.2 16-16l0-128c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 89.4L278.6 256 448 86.6l0 89.4c0 8.8 7.2 16 16 16s16-7.2 16-16l0-128c0-8.8-7.2-16-16-16L336 32z"/>
</svg>
