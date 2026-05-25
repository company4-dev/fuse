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
    <path style="opacity:0.4" d="M32 96l0 320c0 17.7 14.3 32 32 32l224 0 0-384L64 64C46.3 64 32 78.3 32 96z"/><path class="fa-primary" d="M64 64C46.3 64 32 78.3 32 96l0 320c0 17.7 14.3 32 32 32l224 0 0-384L64 64zm384 0L320 64l0 384 128 0c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32zm0-32c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96C0 60.7 28.7 32 64 32l384 0zM432 96c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0zm16 80c0 8.8-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0c8.8 0 16 7.2 16 16zm-16 48c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0z"/>
</svg>
