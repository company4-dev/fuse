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
    <path style="opacity:0.4" d="M34.3 224L224 224l0-189.7C125.9 48.3 48.3 125.9 34.3 224z"/><path class="fa-primary" d="M224 34.3L224 224 34.3 224C48.3 125.9 125.9 48.3 224 34.3zM2 224.1C-.2 241.6 14.3 256 32 256l192 0c17.7 0 32-14.3 32-32l0-192c0-17.7-14.4-32.2-31.9-30C108.2 16.4 16.4 108.2 2 224.1z"/>
</svg>
