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
    <path style="opacity:0.4" d="M32 112l0 64c0 8.8 7.2 16 16 16l80 0 0-96L48 96c-8.8 0-16 7.2-16 16zm0 224l0 64c0 8.8 7.2 16 16 16l144 0 0-96L48 320c-8.8 0-16 7.2-16 16z"/><path class="fa-primary" d="M272 32c8.8 0 16 7.2 16 16l0 16 176 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-176 0 0 16c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-16L48 224c-26.5 0-48-21.5-48-48l0-64C0 85.5 21.5 64 48 64l208 0 0-16c0-8.8 7.2-16 16-16zM160 96l0 96 96 0 0-96-96 0zm128 0l0 96 176 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16L288 96zM128 96L48 96c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l80 0 0-96zM368 256c8.8 0 16 7.2 16 16l0 16 80 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-80 0 0 16c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-16L48 448c-26.5 0-48-21.5-48-48l0-64c0-26.5 21.5-48 48-48l304 0 0-16c0-8.8 7.2-16 16-16zM224 416l128 0 0-96-128 0 0 96zm160-96l0 96 80 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-80 0zm-192 0L48 320c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l144 0 0-96z"/>
</svg>
