{{-- Bypass the Form Helper so we can make full use of AlpineJS for hiding/unhiding on the fly --}}
<div x-data="{{ $alpine_data }}">
    {{-- Start Date --}}
    <flux:field class="mb-5">
        <flux:label :badge="$required ? ___('dictionary.required') : null">
            {{ ___($fields['start-date']['label']) }}
        </flux:label>

        <flux:date-picker :placeholder="___('dictionary.select...')" wire:model.change="{{ $fields['start-date']['name'] }}"/>

        <flux:error name="{{ $fields['start-date']['name'] }}" />
    </flux:field>

    {{-- End Type --}}
    <flux:field class="mb-5">
        <flux:radio.group
            :badge="$required ? ___('dictionary.required') : null"
            :label="___($fields['end-type']['label'])"
            wire:model.change="{{ $fields['end-type']['name'] }}"
            x-on:change="alpine_end_type = $event.target.value"
        >
            <div class="flex gap-4 *:gap-x-2">
                @foreach ($fields['end-type']['options'] as $val => $text)
                    <flux:radio :value="$val" :label="___($text)" />
                @endforeach
            </div>
        </flux:radio.group>

        <flux:error name="{{ $fields['end-type']['name'] }}" />
    </flux:field>

    {{-- End Date (End Type === 1) --}}
    <flux:field class="mb-5" x-show="alpine_end_type == 1">
        <flux:label :badge="$required ? ___('dictionary.required') : null">
            {{ ___($fields['end-date']['label']) }}
        </flux:label>

        <flux:date-picker :placeholder="___('dictionary.select...')" wire:model.change="{{ $fields['end-date']['name'] }}" />

        <flux:error name="{{ $fields['end-date']['name'] }}" />
    </flux:field>

    {{-- End After (End Type === 2) --}}
    <flux:field class="mb-5" x-show="alpine_end_type == 2">
        <flux:label :badge="$required ? ___('dictionary.required') : null">
            {{ ___($fields['end-after']['label']) }}
        </flux:label>

        <flux:input.group>
            <flux:input.group.prefix>
                {{ ___($fields['end-after']['prefix']) }}
            </flux:input.group.prefix>

            <flux:input
                :max="$fields['end-after']['max']"
                :min="$fields['end-after']['min']"
                :placeholder="___($fields['end-after']['label'])"
                type="number"
                wire:model.live="{{ $fields['end-after']['name'] }}"
            />

            <flux:input.group.suffix>
                {{ ___($fields['end-after']['suffix']) }}
            </flux:input.group.suffix>
        </flux:input.group>

        <flux:error name="{{ $fields['end-after']['name'] }}" />
    </flux:field>

    @if ($time)
        <x-separator />

        {{-- Start Time --}}
        <flux:field class="mb-5">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['start-time']['label']) }}
            </flux:label>

            <flux:input
                :placeholder="___($fields['start-time']['label'])"
                type="time"
                wire:model.live="{{ $fields['start-time']['name'] }}"
            />

            <flux:error name="{{ $fields['start-time']['name'] }}" />
        </flux:field>

        {{-- End Time --}}
        <flux:field class="mb-5">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['end-time']['label']) }}
            </flux:label>

            <flux:input
                :placeholder="___($fields['end-time']['label'])"
                type="time"
                wire:model.live="{{ $fields['end-time']['name'] }}"
            />

            <flux:error name="{{ $fields['end-time']['name'] }}" />
        </flux:field>
    @endif

    <x-separator />

    {{-- Recurrence --}}
    <flux:field class="mb-5">
        <flux:radio.group
            :badge="$required ? ___('dictionary.required') : null"
            :label="___($fields['schedule']['label'])"
            wire:model.change="{{ $fields['schedule']['name'] }}"
            x-on:change="alpine_recurrence = $event.target.value"
        >
            <div class="flex gap-4 *:gap-x-2">
                @foreach ($fields['schedule']['options'] as $val => $text)
                    <flux:radio :value="$val" :label="___($text)" />
                @endforeach
            </div>
        </flux:radio.group>

        <flux:error name="{{ $fields['schedule']['name'] }}" />
    </flux:field>

    <flux:separator class="mt-3 mb-5" x-show="alpine_recurrence !== null" />

    {{-- Daily --}}
    <div x-show="alpine_recurrence == 1">
        {{-- Recurrence Type --}}
        <flux:field class="mb-5">
            <flux:radio.group
                :badge="$required ? ___('dictionary.required') : null"
                :label="___($fields['daily-type']['label'])"
                wire:model.change="{{ $fields['daily-type']['name'] }}"
                x-on:change="alpine_recurrence_type_1 = $event.target.value"
            >
                <div class="flex gap-4 *:gap-x-2">
                    @foreach ($fields['daily-type']['options'] as $val => $text)
                        <flux:radio :value="$val" :label="___($text)" />
                    @endforeach
                </div>
            </flux:radio.group>

            <flux:error name="{{ $fields['daily-type']['name'] }}" />
        </flux:field>

        {{-- Interval --}}
        <flux:field class="mb-5" x-show="alpine_recurrence_type_1 == 1">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['daily-interval']['label']) }}
            </flux:label>

            <flux:input.group>
                <flux:input.group.prefix>
                    {{ ___($fields['daily-interval']['prefix']) }}
                </flux:input.group.prefix>

                <flux:input
                    :max="$fields['daily-interval']['max']"
                    :min="$fields['daily-interval']['min']"
                    :placeholder="___($fields['daily-interval']['label'])"
                    type="number"
                    wire:model.live="{{ $fields['daily-interval']['name'] }}"
                />

                <flux:input.group.suffix>
                    {{ ___($fields['daily-interval']['suffix']) }}
                </flux:input.group.suffix>
            </flux:input.group>

            <flux:error name="{{ $fields['daily-interval']['name'] }}" />
        </flux:field>
    </div>

    {{-- Weekly --}}
    <div x-show="alpine_recurrence == 2">
        {{-- Interval --}}
        <flux:field class="mb-5">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['daily-interval']['label']) }}
            </flux:label>

            <flux:input.group>
                <flux:input.group.prefix>
                    {{ ___($fields['daily-interval']['prefix']) }}
                </flux:input.group.prefix>

                <flux:input
                    :max="$fields['daily-interval']['max']"
                    :min="$fields['daily-interval']['min']"
                    :placeholder="___($fields['daily-interval']['label'])"
                    type="number"
                    wire:model.live="{{ $fields['daily-interval']['name'] }}"
                />

                <flux:input.group.suffix>
                    {{ ___($fields['daily-interval']['suffix']) }}
                </flux:input.group.suffix>
            </flux:input.group>

            <flux:error name="{{ $fields['daily-interval']['name'] }}" />
        </flux:field>

        {{-- On --}}
        <flux:field class="mb-5">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['weekly-on']['label']) }}
            </flux:label>

            <flux:select
                clearable
                :placeholder="___('dictionary.select...')"
                searchable
                variant="listbox"
                wire:model.change="{{ $fields['weekly-on']['name'] }}"
                x-on:change="alpine_recurrence_type_3 = $event.target.value"
            >
                @foreach ($fields['weekly-on']['options'] as $val => $text)
                    <flux:select.option :value="$val" :wire:key="$val">
                        {!! ___($text) !!}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:error name="{{ $fields['weekly-on']['name'] }}" />
        </flux:field>
    </div>

    {{-- Monthly --}}
    <div x-show="alpine_recurrence == 3">
        {{-- X Months --}}
        <flux:field class="mb-5">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['monthly-every']['label']) }}
            </flux:label>

            <flux:input.group>
                <flux:input.group.prefix>
                    {{ ___($fields['monthly-every']['prefix']) }}
                </flux:input.group.prefix>

                <flux:input
                    :max="$fields['monthly-every']['max']"
                    :min="$fields['monthly-every']['min']"
                    :placeholder="___($fields['monthly-every']['label'])"
                    type="number"
                    wire:model.live="{{ $fields['monthly-every']['name'] }}"
                />

                <flux:input.group.suffix>
                    {{ ___($fields['monthly-every']['suffix']) }}
                </flux:input.group.suffix>
            </flux:input.group>

            <flux:error name="{{ $fields['monthly-every']['name'] }}" />
        </flux:field>

        {{-- Recurrence Type --}}
        <flux:field class="mb-5">
            <flux:radio.group
                :badge="$required ? ___('dictionary.required') : null"
                :label="___($fields['monthly-type']['label'])"
                wire:model.change="{{ $fields['monthly-type']['name'] }}"
                x-on:change="alpine_recurrence_type_3 = $event.target.value"
            >
                <div class="flex gap-4 *:gap-x-2">
                    @foreach ($fields['monthly-type']['options'] as $val => $text)
                        <flux:radio :value="$val" :label="___($text)" />
                    @endforeach
                </div>
            </flux:radio.group>

            <flux:error name="{{ $fields['monthly-type']['name'] }}" />
        </flux:field>

        {{-- Specific Date - Day --}}
        <flux:field class="mb-5" x-show="alpine_recurrence_type_3 == 1">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['monthly-day']['label']) }}
            </flux:label>

            <flux:select
                clearable
                :placeholder="___('dictionary.select...')"
                searchable
                variant="listbox"
                wire:model.change="{{ $fields['monthly-day']['name'] }}"
            >
                @foreach ($fields['monthly-day']['options'] as $val)
                    <flux:select.option :value="$val" :wire:key="$val">
                        {!! ___($val) !!}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:error name="{{ $fields['monthly-day']['name'] }}" />
        </flux:field>

        {{-- nth Date --}}
        <div x-show="alpine_recurrence_type_3 == 2">
            {{-- nth week --}}
            <flux:field class="mb-5">
                <flux:radio.group
                    :badge="$required ? ___('dictionary.required') : null"
                    :label="___($fields['monthly-week']['label'])"
                    wire:model.change="{{ $fields['monthly-week']['name'] }}"
                >
                    <div class="flex gap-4 *:gap-x-2">
                        @foreach ($fields['monthly-week']['options'] as $val => $text)
                            <flux:radio :value="$val" :label="___($text)" />
                        @endforeach
                    </div>
                </flux:radio.group>

                <flux:error name="{{ $fields['monthly-week']['name'] }}" />
            </flux:field>

            {{-- Day of Week --}}
            <flux:field class="mb-5">
                <flux:label :badge="$required ? ___('dictionary.required') : null">
                    {{ ___($fields['monthly-dow']['label']) }}
                </flux:label>

                <flux:select
                    clearable
                    :placeholder="___('dictionary.select...')"
                    searchable
                    variant="listbox"
                    wire:model.change="{{ $fields['monthly-dow']['name'] }}"
                >
                    @foreach ($fields['monthly-dow']['options'] as $val => $text)
                        <flux:select.option :value="$val" :wire:key="$val">
                            {!! ___($text) !!}
                        </flux:select.option>
                    @endforeach
                </flux:select>

                <flux:error name="{{ $fields['monthly-dow']['name'] }}" />
            </flux:field>
        </div>
    </div>

    {{-- Yearly --}}
    <div x-show="alpine_recurrence == 4">
        {{-- Interval --}}
        <flux:field class="mb-5">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['yearly-interval']['label']) }}
            </flux:label>

            <flux:input.group>
                <flux:input.group.prefix>
                    {{ ___($fields['yearly-interval']['prefix']) }}
                </flux:input.group.prefix>

                <flux:input
                    :max="$fields['yearly-interval']['max']"
                    :min="$fields['yearly-interval']['min']"
                    :placeholder="___($fields['yearly-interval']['name'])"
                    type="number"
                    wire:model.live="{{ $fields['yearly-interval']['name'] }}"
                />

                <flux:input.group.suffix>
                    {{ ___($fields['yearly-interval']['suffix']) }}
                </flux:input.group.suffix>
            </flux:input.group>

            <flux:error name="{{ $fields['yearly-interval']['name'] }}" />
        </flux:field>

        {{-- Recurrence Type --}}
        <flux:field class="mb-5">
            <flux:radio.group
                :badge="$required ? ___('dictionary.required') : null"
                :label="___($fields['yearly-type']['label'])"
                wire:model.change="{{ $fields['yearly-type']['name'] }}"
                x-on:change="alpine_recurrence_type_4 = $event.target.value"
            >
                <div class="flex gap-4 *:gap-x-2">
                    @foreach ($fields['yearly-type']['options'] as $val => $text)
                        <flux:radio :value="$val" :label="___($text)" />
                    @endforeach
                </div>
            </flux:radio.group>

            <flux:error name="{{ $fields['yearly-type']['name'] }}" />
        </flux:field>

        {{-- Specific Date - Day --}}
        <flux:field class="mb-5" x-show="alpine_recurrence_type_4 == 1">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['yearly-day']['name']) }}
            </flux:label>

            <flux:select
                clearable
                :placeholder="___('dictionary.select...')"
                searchable
                variant="listbox"
                wire:model.change="{{ $fields['yearly-day']['name'] }}"
            >
                @foreach ($fields['yearly-day']['options'] as $val)
                    <flux:select.option :value="$val" :wire:key="$val">
                        {!! ___($val) !!}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:error name="{{ $fields['yearly-day']['name'] }}" />
        </flux:field>

        {{-- Nth Date --}}
        <div x-show="alpine_recurrence_type_4 == 2">
            {{-- nth week --}}
            <flux:field class="mb-5">
                <flux:radio.group
                    :badge="$required ? ___('dictionary.required') : null"
                    :label="___($fields['yearly-week']['label'])"
                    wire:model.change="{{ $fields['yearly-week']['name'] }}"
                >
                    <div class="flex gap-4 *:gap-x-2">
                        @foreach ($fields['yearly-week']['options'] as $val => $text)
                            <flux:radio :value="$val" :label="___($text)" />
                        @endforeach
                    </div>
                </flux:radio.group>

                <flux:error name="{{ $fields['yearly-week']['name'] }}" />
            </flux:field>

            {{-- Day of Week --}}
            <flux:field class="mb-5">
                <flux:label :badge="$required ? ___('dictionary.required') : null">
                    {{ ___($fields['yearly-dow']['label']) }}
                </flux:label>

                <flux:select
                    clearable
                    :placeholder="___('dictionary.select...')"
                    searchable
                    variant="listbox"
                    wire:model.change="{{ $fields['yearly-dow']['name'] }}"
                >
                    @foreach ($fields['yearly-dow']['options'] as $val => $text)
                        <flux:select.option :value="$val" :wire:key="$val">
                            {!! ___($text) !!}
                        </flux:select.option>
                    @endforeach
                </flux:select>

                <flux:error name="{{ $fields['yearly-dow']['name'] }}" />
            </flux:field>
        </div>

        {{-- Month --}}
        <flux:field class="mb-5" x-show="alpine_recurrence_type_4 == 1 || recurrence_type_4 == 2">
            <flux:label :badge="$required ? ___('dictionary.required') : null">
                {{ ___($fields['yearly-month']['label']) }}
            </flux:label>

            <flux:select
                clearable
                :placeholder="___('dictionary.select...')"
                searchable
                variant="listbox"
                wire:model.change="{{ $fields['yearly-month']['name'] }}"
            >
                @foreach ($fields['yearly-month']['options'] as $val => $text)
                    <flux:select.option :value="$val" :wire:key="$val">
                        {!! ___($text) !!}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:error name="{{ $fields['yearly-month']['name'] }}" />
        </flux:field>
    </div>
</div>
