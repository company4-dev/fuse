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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 640 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M115.3 172.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l88 88c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-88-88zM304 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-128c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 128zm132.7 36.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l88-88c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0l-88 88zM0 400c0 8.8 7.2 16 16 16l96 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-96 0c-8.8 0-16 7.2-16 16zm208-16c-8.8 0-16 7.2-16 16s7.2 16 16 16l224 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-224 0zm320 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l96 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-96 0z"/>
</svg>
