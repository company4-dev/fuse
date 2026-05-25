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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M72.7 32C50.2 32 32 50.2 32 72.7L32 160l-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 0 112 0 160c0 8.8 7.2 16 16 16s16-7.2 16-16l0-144 144 0c74.1 0 135.2-56 143.1-128l16.9 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16.9 0c-8-72-69-128-143.1-128L72.7 32zM318.9 160L64 160l0-87.3c0-4.8 3.9-8.7 8.7-8.7L208 64c56.4 0 103.1 41.7 110.9 96zM64 192l254.9 0c-7.8 54.3-54.4 96-110.9 96L64 288l0-96z"/>
</svg>
