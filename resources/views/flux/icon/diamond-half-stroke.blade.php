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
    <path style="opacity:0.4" d="M34.3 250.3c-3.1 3.1-3.1 8.2 0 11.3L240 467.3l0-422.6L34.3 250.3z"/><path class="fa-primary" d="M272 44.7l0 422.6L477.7 261.7c3.1-3.1 3.1-8.2 0-11.3L272 44.7zM240 467.3l0-422.6L34.3 250.3c-3.1 3.1-3.1 8.2 0 11.3L240 467.3zM227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216z"/>
</svg>
