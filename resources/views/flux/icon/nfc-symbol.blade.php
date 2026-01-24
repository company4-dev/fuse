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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M367.2 475.6c5.1 4.9 12.9 5.8 19 2.2C462.2 433.9 513.1 349.8 513.1 256s-50.9-177.9-126.8-221.8c-7.6-4.4-17.4-1.8-21.9 5.8s-1.8 17.4 5.8 21.9C436.4 100.1 481.1 173.8 481.1 256c0 78-40.2 148.2-100.8 187.9L203 276.4c-6.4-6.1-16.5-5.8-22.6 .6s-5.8 16.5 .6 22.6l186.2 176zM145.9 36.4c-5.1-4.9-12.9-5.8-19-2.3C50.9 78.1 0 162.2 0 256s50.9 177.9 126.8 221.8c7.6 4.4 17.4 1.8 21.9-5.8s1.8-17.4-5.8-21.9C76.7 411.9 32 338.2 32 256c0-77.9 40.2-148.2 100.8-187.9L309 235.6c6.4 6.1 16.5 5.8 22.6-.6s5.8-16.5-.6-22.6L145.9 36.4z"/>
</svg>
