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
    <path style="opacity:0.4" d="M32 64c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32l0 64-32 0 0-32c0-17.7-14.3-32-32-32L96 64C78.3 64 64 78.3 64 96l0 160c0 17.7 14.3 32 32 32l32 0 0 32-64 0c-17.7 0-32-14.3-32-32L32 64zM96 96l160 0 0 32-32 0c-53 0-96 43-96 96l0 32-32 0L96 96z"/><path class="fa-primary" d="M64 32l224 0c17.7 0 32 14.3 32 32l0 64 32 0 0-64c0-35.3-28.7-64-64-64L64 0C28.7 0 0 28.7 0 64L0 288c0 35.3 28.7 64 64 64l64 0 0-32-64 0c-17.7 0-32-14.3-32-32L32 64c0-17.7 14.3-32 32-32zM288 96c0-17.7-14.3-32-32-32L96 64C78.3 64 64 78.3 64 96l0 160c0 17.7 14.3 32 32 32l32 0 0-32-32 0L96 96l160 0 0 32 32 0 0-32zm-64 96l224 0c17.7 0 32 14.3 32 32l0 224c0 17.7-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32l0-224c0-17.7 14.3-32 32-32zm-64 32l0 224c0 35.3 28.7 64 64 64l224 0c35.3 0 64-28.7 64-64l0-224c0-35.3-28.7-64-64-64l-224 0c-35.3 0-64 28.7-64 64z"/>
</svg>
