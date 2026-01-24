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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M272 16l0 96c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-96c0-8.8 7.2-16 16-16s16 7.2 16 16zm0 384l0 96c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-96c0-8.8 7.2-16 16-16s16 7.2 16 16zM0 256c0-8.8 7.2-16 16-16l96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-96 0c-8.8 0-16-7.2-16-16zm400-16l96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-96 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zM437 75c6.2 6.2 6.2 16.4 0 22.6l-67.9 67.9c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6L414.4 75c6.2-6.2 16.4-6.2 22.6 0zM165.5 369.1L97.6 437c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l67.9-67.9c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6zM75 75c6.2-6.2 16.4-6.2 22.6 0l67.9 67.9c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0L75 97.6c-6.2-6.2-6.2-16.4 0-22.6zM369.1 346.5L437 414.4c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-67.9-67.9c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0z"/>
</svg>
