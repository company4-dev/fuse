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
    <path style="opacity:0.4" d="M32 64c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32l0 64-96 0c-53 0-96 43-96 96l0 96-64 0c-17.7 0-32-14.3-32-32L32 64zM192 384l96 0c53 0 96-43 96-96l0-96 64 0c17.7 0 32 14.3 32 32l0 224c0 17.7-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32l0-64z"/><path class="fa-primary" d="M64 32l224 0c17.7 0 32 14.3 32 32l0 64 32 0 0-64c0-35.3-28.7-64-64-64L64 0C28.7 0 0 28.7 0 64L0 288c0 35.3 28.7 64 64 64l64 0 0-32-64 0c-17.7 0-32-14.3-32-32L32 64c0-17.7 14.3-32 32-32zm96 352l0 64c0 35.3 28.7 64 64 64l224 0c35.3 0 64-28.7 64-64l0-224c0-35.3-28.7-64-64-64l-64 0 0 32 64 0c17.7 0 32 14.3 32 32l0 224c0 17.7-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32l0-64-32 0zm128-32c35.3 0 64-28.7 64-64l-32 0c0 17.7-14.3 32-32 32l-32 0 0 32 32 0zm64-160l0-32-32 0-32 0 0 32 32 0 0 64 32 0 0-64zM224 352l0-32-32 0 0-64-32 0 0 64 0 32 32 0 32 0zM160 224l32 0c0-17.7 14.3-32 32-32l32 0 0-32-32 0c-35.3 0-64 28.7-64 64z"/>
</svg>
