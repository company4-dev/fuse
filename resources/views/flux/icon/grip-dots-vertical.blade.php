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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 256 512" fill="currentColor">
    <path style="opacity:0.4" d="M32 96a16 16 0 1 0 32 0A16 16 0 1 0 32 96zm0 160a16 16 0 1 0 32 0 16 16 0 1 0 -32 0zm0 160a16 16 0 1 0 32 0 16 16 0 1 0 -32 0zM192 96a16 16 0 1 0 32 0 16 16 0 1 0 -32 0zm0 160a16 16 0 1 0 32 0 16 16 0 1 0 -32 0zm0 160a16 16 0 1 0 32 0 16 16 0 1 0 -32 0z"/><path class="fa-primary" d="M64 96A16 16 0 1 0 32 96a16 16 0 1 0 32 0zM0 96a48 48 0 1 1 96 0A48 48 0 1 1 0 96zM64 256a16 16 0 1 0 -32 0 16 16 0 1 0 32 0zM0 256a48 48 0 1 1 96 0A48 48 0 1 1 0 256zM48 432a16 16 0 1 0 0-32 16 16 0 1 0 0 32zm0-64a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM224 96a16 16 0 1 0 -32 0 16 16 0 1 0 32 0zm-64 0a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm48 176a16 16 0 1 0 0-32 16 16 0 1 0 0 32zm0-64a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm16 208a16 16 0 1 0 -32 0 16 16 0 1 0 32 0zm-64 0a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"/>
</svg>
