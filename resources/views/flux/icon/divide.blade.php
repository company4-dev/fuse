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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 448 512" fill="currentColor">
    <path style="opacity:0.4" d="M192 128a32 32 0 1 0 64 0 32 32 0 1 0 -64 0zm0 256a32 32 0 1 0 64 0 32 32 0 1 0 -64 0z"/><path class="fa-primary" d="M224 96a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm0 96a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm0 160a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm0 96a64 64 0 1 0 0-128 64 64 0 1 0 0 128zM416 272c8.8 0 16-7.2 16-16s-7.2-16-16-16L32 240c-8.8 0-16 7.2-16 16s7.2 16 16 16l384 0z"/>
</svg>
