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
    <path style="opacity:0.4" d="M64 287.9c0-56 20.7-107.3 54.7-146.5l182 182c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-182-182C180.6 84.7 231.8 64 288 64c-8.9 .1-16 7.2-16 16c0 8.8 7.2 16 16 16c106 0 192 86 192 192s-86 192-192 192S96 394 96 288c0-8.8-7.2-16-16-16c-8.8 0-15.9 7.1-16 15.9z"/><path class="fa-primary" d="M176 0L16 0C7.2 0 0 7.2 0 16L0 176c0 8.8 7.2 16 16 16s16-7.2 16-16L32 54.6 300.7 323.3c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L54.6 32 176 32c8.8 0 16-7.2 16-16s-7.2-16-16-16zM288 64c-8.8 0-16 7.2-16 16s7.2 16 16 16c106 0 192 86 192 192s-86 192-192 192S96 394 96 288c0-8.8-7.2-16-16-16s-16 7.2-16 16c0 123.7 100.3 224 224 224s224-100.3 224-224S411.7 64 288 64z"/>
</svg>
