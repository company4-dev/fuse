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
    <path style="opacity:0.4" d="M64 96l0 80 0 80 0 80 0 80 64 0 0-320L64 96zm96 0l0 320 320 0 0-320L160 96zm352 0l0 320 64 0 0-80 0-80 0-80 0-80-64 0z"/><path class="fa-primary" d="M16 64C7.2 64 0 71.2 0 80s7.2 16 16 16l16 0 0 64-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 0 48-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 0 48-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 0 64-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 16 0 16 0 512 0 16 0 16 0 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-64 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-48 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-48 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-64 16 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0-16 0-16 0L64 64 48 64 32 64 16 64zM64 96l64 0 0 320-64 0 0-80 0-80 0-80 0-80zm448 0l64 0 0 80 0 80 0 80 0 80-64 0 0-320zm-32 0l0 320-320 0 0-320 320 0z"/>
</svg>
