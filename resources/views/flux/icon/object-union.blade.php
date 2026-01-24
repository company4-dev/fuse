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
    <path style="opacity:0.4" d="M32 64l0 224c0 17.7 14.3 32 32 32l96 0c17.7 0 32 14.3 32 32l0 96c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-224c0-17.7-14.3-32-32-32l-96 0c-17.7 0-32-14.3-32-32l0-96c0-17.7-14.3-32-32-32L64 32C46.3 32 32 46.3 32 64z"/><path class="fa-primary" d="M160 320c17.7 0 32 14.3 32 32l0 96c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-224c0-17.7-14.3-32-32-32l-96 0c-17.7 0-32-14.3-32-32l0-96c0-17.7-14.3-32-32-32L64 32C46.3 32 32 46.3 32 64l0 224c0 17.7 14.3 32 32 32l96 0zm-32 32l-64 0c-35.3 0-64-28.7-64-64L0 64C0 28.7 28.7 0 64 0L288 0c35.3 0 64 28.7 64 64l0 64 0 32 32 0 64 0c35.3 0 64 28.7 64 64l0 224c0 35.3-28.7 64-64 64l-224 0c-35.3 0-64-28.7-64-64l0-64 0-32-32 0z"/>
</svg>
