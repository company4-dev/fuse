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
    <path style="opacity:0.4" d="M32 224l448 0 0 192c0 17.7-14.3 32-32 32L64 448c-17.7 0-32-14.3-32-32l0-192z"/><path class="fa-primary" d="M64 64C46.3 64 32 78.3 32 96l0 96 448 0 0-96c0-17.7-14.3-32-32-32L64 64zM32 224l0 192c0 17.7 14.3 32 32 32l384 0c17.7 0 32-14.3 32-32l0-192L32 224zM0 96C0 60.7 28.7 32 64 32l384 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96z"/>
</svg>
