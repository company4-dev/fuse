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
    <path style="opacity:0.4" d="M48 256a144 144 0 1 0 288 0A144 144 0 1 0 48 256z"/><path class="fa-primary" d="M192 112a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm0 320a176 176 0 1 0 0-352 176 176 0 1 0 0 352z"/>
</svg>
