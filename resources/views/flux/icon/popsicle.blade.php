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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 320 512" fill="currentColor">
    <path style="opacity:0.4" d="M32 160l0 176c0 8.8 7.2 16 16 16l96 0 0-160c0-8.8 7.2-16 16-16s16 7.2 16 16l0 160 96 0c8.8 0 16-7.2 16-16l0-176c0-70.7-57.3-128-128-128S32 89.3 32 160z"/><path class="fa-primary" d="M288 160c0-70.7-57.3-128-128-128S32 89.3 32 160l0 176c0 8.8 7.2 16 16 16l96 0 0-160c0-8.8 7.2-16 16-16s16 7.2 16 16l0 160 96 0c8.8 0 16-7.2 16-16l0-176zM144 384l-96 0c-26.5 0-48-21.5-48-48L0 160C0 71.6 71.6 0 160 0s160 71.6 160 160l0 176c0 26.5-21.5 48-48 48l-96 0 0 112c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-112z"/>
</svg>
