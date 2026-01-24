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
    <path style="opacity:0.4" d="M288 96l288 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-288 0 0-320z"/><path class="fa-primary" d="M256 96l0 320L64 416c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l192 0zm32 0l288 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-288 0 0-320zM64 64C28.7 64 0 92.7 0 128L0 384c0 35.3 28.7 64 64 64l512 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64L64 64zm112 96c8.8 0 16 7.2 16 16l0 160c0 8.8-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16l0-160c0-8.8 7.2-16 16-16l64 0zm-64-32c-26.5 0-48 21.5-48 48l0 160c0 26.5 21.5 48 48 48l64 0c26.5 0 48-21.5 48-48l0-160c0-26.5-21.5-48-48-48l-64 0z"/>
</svg>
