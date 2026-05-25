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
    <path style="opacity:0.4" d="M64 64l0 192 176 0 0-224L96 32C78.3 32 64 46.3 64 64zm0 224l0 192 176 0 0-192L64 288zM272 32l0 224 176 0 0-192c0-17.7-14.3-32-32-32L272 32zm0 256l0 192 176 0 0-192-176 0z"/><path class="fa-primary" d="M240 288l0 192L64 480l0-192 176 0zm32 192l0-192 176 0 0 192-176 0zm208 0l0-416c0-35.3-28.7-64-64-64L96 0C60.7 0 32 28.7 32 64l0 416-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 32 0 384 0 32 0 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0zM448 256l-176 0 0-224 144 0c17.7 0 32 14.3 32 32l0 192zM96 32l144 0 0 224L64 256 64 64c0-17.7 14.3-32 32-32z"/>
</svg>
