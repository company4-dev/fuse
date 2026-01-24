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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M46.4 195.6C40.3 262.4 92.9 320 160 320s119.7-57.6 113.6-124.4L258.8 32 61.2 32 46.4 195.6zm-31.9-2.9L29.4 29.1C30.9 12.6 44.7 0 61.2 0L258.8 0c16.6 0 30.4 12.6 31.9 29.1l14.9 163.6c7.3 80.2-51.4 150-129.5 158.5L176 480l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-80 0-80 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l64 0 0-128.9C65.9 342.7 7.2 272.8 14.5 192.7z"/>
</svg>
