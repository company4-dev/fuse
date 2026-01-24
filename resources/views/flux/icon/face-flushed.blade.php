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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm208-32A80 80 0 1 1 80 224a80 80 0 1 1 160 0zM176 384c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16zM432 224a80 80 0 1 1 -160 0 80 80 0 1 1 160 0z"/><path class="fa-primary" d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm160.4-56a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm168 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM192 368l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm-32-96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm0-128a80 80 0 1 1 0 160 80 80 0 1 1 0-160zm240 80a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm-128 0a80 80 0 1 1 160 0 80 80 0 1 1 -160 0z"/>
</svg>
