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
    <path style="opacity:0.4" d="M192 144a112 112 0 1 0 224 0 112 112 0 1 0 -224 0z"/><path class="fa-primary" d="M304 32a112 112 0 1 1 0 224 112 112 0 1 1 0-224zm0 256c79.5 0 144-64.5 144-144S383.5 0 304 0S160 64.5 160 144c0 34 11.8 65.2 31.5 89.9L4.7 420.7c-6.2 6.2-6.2 16.4 0 22.6l64 64c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L38.6 432 80 390.6l52.7 52.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L102.6 368 214.1 256.5C238.8 276.2 270 288 304 288z"/>
</svg>
