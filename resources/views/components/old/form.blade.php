@props(['model'])

<form wire:submit.prevent="{{ $action }}">
    @csrf

    @if ($errors->any())
        <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @foreach ($fields as $field)
        @if ($field['is_component'])
            @include('components.'.str_replace('component.', '', $field['type']), $field)
        @else
            <x-dynamic-component :component="$field['component']" :$field />
        @endif
    @endforeach

    <div>
        @foreach ($actions as $action)
            <x-dynamic-component :$action :component="$action['component']" />
        @endforeach
    </div>
</form>
