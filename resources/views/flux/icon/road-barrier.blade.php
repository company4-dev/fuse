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
    <path style="opacity:0.4" d="M32 112l0 160 38.1 0 80-160L32 112zM233.9 272l92.2 0 80-160-92.2 0-80 160zm256 0L608 272l0-160-38.1 0-80 160z"/><path class="fa-primary" d="M16 32c8.8 0 16 7.2 16 16l0 32 576 0 0-32c0-8.8 7.2-16 16-16s16 7.2 16 16l0 32 0 32 0 160 0 32 0 160c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-160L32 304l0 160c0 8.8-7.2 16-16 16s-16-7.2-16-16L0 304l0-32L0 112 0 80 0 48c0-8.8 7.2-16 16-16zM608 272l0-160-38.1 0-80 160L608 272zM32 272l38.1 0 80-160L32 112l0 160zM406.1 112l-92.2 0-80 160 92.2 0 80-160zm35.8 0l-80 160 92.2 0 80-160-92.2 0zm-256 0l-80 160 92.2 0 80-160-92.2 0z"/>
</svg>
