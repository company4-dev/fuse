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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M33 32L479 32c.5 0 1 .4 1 1c0 .3-.1 .5-.3 .7L256 257.4 32.3 33.7c-.2-.2-.3-.4-.3-.7c0-.5 .4-1 1-1zm479 1c0-18.2-14.8-33-33-33L33 0C14.8 0 0 14.8 0 33c0 8.7 3.5 17.1 9.7 23.3L240 286.6 240 480l-96 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l112 0 112 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-96 0 0-193.4L502.3 56.3c6.2-6.2 9.7-14.6 9.7-23.3z"/>
</svg>
