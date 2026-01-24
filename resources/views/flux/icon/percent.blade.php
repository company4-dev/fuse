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
    <path style="opacity:0.4" d="M32 128a32 32 0 1 0 64 0 32 32 0 1 0 -64 0zM288 384a32 32 0 1 0 64 0 32 32 0 1 0 -64 0z"/><path class="fa-primary" d="M64 96a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm0 96A64 64 0 1 0 64 64a64 64 0 1 0 0 128zM320 352a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm0 96a64 64 0 1 0 0-128 64 64 0 1 0 0 128zM379.3 91.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0l-352 352c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l352-352z"/>
</svg>
