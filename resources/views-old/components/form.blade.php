<form wire:submit.prevent="submit">
    @csrf

    @if ($errors->any())
        <x-callout class="mb-3" variant="danger">
            {{ ___('errors.form.submit') }}

            <ol class="mt-3 list-decimal list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ol>
        </x-callout>

        <x-separator />
    @endif

    @if ($type === 'inline')
        <div class="grid sm:grid-cols-2 md:grid-cols-3 ls:grid-cols-4 2xl:grid-cols-5 gap-4">
    @endif

    @foreach ($sections as $section => $section_data)
        @if ($type === 'inline')
            @foreach ($section_data['fields'] as $field)
                @if ($field['is_component'])
                    @include('components.'.str_replace('component.', '', $field['type']), $field)
                @elseif ($field['is_livewire'])
                    @livewire('form.'.$field['type'], ['field' => $field, 'form' => $form])
                @else
                    <x-dynamic-component :component="$field['component']" :$field />
                @endif
            @endforeach
        @else
            @php($show_section = (bool) array_filter(array_map(fn ($item) => $item['hidden'] === false, $section_data['fields'])))

            @if (!$loop->first && $show_section && $type !== 'ungrouped')
                <x-separator />
            @endif

            @if ($show_section)
                @if ($type !== 'ungrouped')
                    <div class="flex items-start max-md:flex-col">
                        <div class="me-10 w-full pb-4 md:w-[300px] lg:w-[400px]">
                            {{ ___($section) }}
                            @if ($section_data['description'])
                                <br>
                                <small>{{ ___($section_data['description']) }}</small>
                            @endif
                        </div>

                        <flux:separator class="md:hidden" />

                        <div class="flex-1 self-stretch max-md:pt-6">
                @endif

                @foreach ($section_data['fields'] as $field)
                    @if ($field['is_component'])
                        <x-dynamic-component :component="str_replace('component.', '', $field['type'])" :$field />
                    @elseif ($field['is_livewire'])
                        @livewire('form.'.$field['type'], ['field' => $field, 'form' => $form])
                    @else
                        <x-dynamic-component :component="$field['component']" :$field />
                    @endif
                @endforeach

                @if ($type !== 'ungrouped')
                        </div>
                    </div>
                @endif
            @endif
        @endif
    @endforeach

    @if ($type === 'inline')
        </div>
    @else
        <flux:separator class="mt-3 mb-6" wire:loading.remove />
    @endif

    <div class="flex justify-end items-center gap-3" wire:loading.remove>
        @foreach ($actions as $action)
            <x-dynamic-component :$action :component="$action['component']" />
        @endforeach
    </div>
</form>
