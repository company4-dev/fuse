<{{ $attributes->get('tag') ?? 'div' }} {{ $attributes->except('tag')->merge([
    'class' => 'card card-body bg-neutral text-neutral-content'
]) }}>
    {{ $slot }}
</{{ $attributes->get('tag') ?? 'div' }}>
