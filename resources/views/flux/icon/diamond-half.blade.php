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
    <path style="opacity:0.4" d="M34.3 250.3c-3.1 3.1-3.1 8.2 0 11.3L224 451.3l0-390.6L34.3 250.3z"/><path class="fa-primary" d="M227.7 11.7C235.5 3.9 245.8 0 256 0l0 32 0 448 0 32c-10.2 0-20.5-3.9-28.3-11.7l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zM224 451.3l0-390.6L34.3 250.3c-3.1 3.1-3.1 8.2 0 11.3L224 451.3z"/>
</svg>
