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
    <path style="opacity:0.4" d="M128 96l32 0 0 32 208 0c8.8 0 16 7.2 16 16l0 272-32 0 0-32-208 0c-8.8 0-16-7.2-16-16l0-272z"/><path class="fa-primary" d="M128 16c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 80L16 96c-8.8 0-16 7.2-16 16s7.2 16 16 16l80 0 0 240c0 26.5 21.5 48 48 48l208 0 0-32-208 0c-8.8 0-16-7.2-16-16l0-352zM384 496c0 8.8 7.2 16 16 16s16-7.2 16-16l0-80 80 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-80 0 0-240c0-26.5-21.5-48-48-48L160 96l0 32 208 0c8.8 0 16 7.2 16 16l0 352z"/>
</svg>
