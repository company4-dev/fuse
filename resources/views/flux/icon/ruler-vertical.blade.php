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
    <path style="opacity:0.4" d="M32 64l0 384c0 17.7 14.3 32 32 32l128 0c17.7 0 32-14.3 32-32l0-32-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0 0-64-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0 0-64-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0 0-64-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0 0-32c0-17.7-14.3-32-32-32L64 32C46.3 32 32 46.3 32 64z"/><path class="fa-primary" d="M192 32c17.7 0 32 14.3 32 32l0 32-64 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l64 0 0 64-64 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l64 0 0 64-64 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l64 0 0 64-64 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l64 0 0 32c0 17.7-14.3 32-32 32L64 480c-17.7 0-32-14.3-32-32L32 64c0-17.7 14.3-32 32-32l128 0zM64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l128 0c35.3 0 64-28.7 64-64l0-384c0-35.3-28.7-64-64-64L64 0z"/>
</svg>
