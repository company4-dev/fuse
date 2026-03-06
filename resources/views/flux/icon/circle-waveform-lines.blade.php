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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm96-80c0-8.8 7.2-16 16-16s16 7.2 16 16l0 160c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-160zm64 40c0-8.8 7.2-16 16-16s16 7.2 16 16l0 80c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-80zm64-72c0-8.8 7.2-16 16-16s16 7.2 16 16l0 224c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-224zm64 56c0-8.8 7.2-16 16-16s16 7.2 16 16l0 112c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-112zm64 40c0-8.8 7.2-16 16-16s16 7.2 16 16l0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-32z"/><path class="fa-primary" d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM288 144l0 224c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-224c0-8.8 7.2-16 16-16s16 7.2 16 16zM160 176l0 160c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-160c0-8.8 7.2-16 16-16s16 7.2 16 16zm192 24l0 112c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-112c0-8.8 7.2-16 16-16s16 7.2 16 16zM224 216l0 80c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-80c0-8.8 7.2-16 16-16s16 7.2 16 16zm192 24l0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
</svg>
