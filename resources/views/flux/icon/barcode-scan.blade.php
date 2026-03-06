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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 640 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M64 48l0 144 32 0L96 48c0-8.8-7.2-16-16-16s-16 7.2-16 16zm0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-144-32 0 0 144zm96 0l0-144-32 0 0 144c0 8.8 7.2 16 16 16s16-7.2 16-16zM128 48l0 144 32 0 0-144c0-8.8-7.2-16-16-16s-16 7.2-16 16zm64 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-144-32 0 0 144zm0-416l0 144 32 0 0-144c0-8.8-7.2-16-16-16s-16 7.2-16 16zm96 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-144-32 0 0 144zm0-416l0 144 32 0 0-144c0-8.8-7.2-16-16-16s-16 7.2-16 16zm64 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-144-32 0 0 144zm0-416l0 144 32 0 0-144c0-8.8-7.2-16-16-16s-16 7.2-16 16zm96 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-144-32 0 0 144zm0-416l0 144 32 0 0-144c0-8.8-7.2-16-16-16s-16 7.2-16 16zm96 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-144-32 0 0 144zm0-416l0 144 32 0 0-144c0-8.8-7.2-16-16-16s-16 7.2-16 16zM0 256c0 8.8 7.2 16 16 16l608 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L16 240c-8.8 0-16 7.2-16 16z"/>
</svg>
