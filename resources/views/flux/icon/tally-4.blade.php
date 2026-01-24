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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M144 48c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416zm128 0c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416zM384 32c-8.8 0-16 7.2-16 16l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416c0-8.8-7.2-16-16-16zM528 48c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416z"/>
</svg>
