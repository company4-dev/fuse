@use('Livewire\Features\SupportFileUploads\TemporaryUploadedFile')

<flux:field class="mb-5" :$hidden>
    <flux:label :badge="$required ? ___('dictionary.required') : null">{{ $label }}</flux:label>

    <flux:file-upload :wire:model="$name">
        <flux:file-upload.dropzone
            :heading="___('messages.components.form.file.heading')"
            inline
            :text="$accepts"
            with-progress
        />
    </flux:file-upload>

    <flux:error class="mt-0!" :$name />

    @if ($description)
        <flux:description class="mt-0!">{!! $description !!}</flux:description>
    @endif

    @if ($files)
        <div class="mt-4 flex flex-col gap-2">
            <flux:text>{{ ___('phrases.saved-files') }}</flux:text>
            @foreach ($files as $i => $file)
                @if ($file instanceof TemporaryUploadedFile)
                    <flux:file-item
                        :heading="$file->getClientOriginalName()"
                        :size="$file->getSize()"
                        :image="$file->isPreviewable() ? $file->temporaryUrl() : null"
                    >
                        <x-slot name="actions">
                            @if ($can_delete)
                                <flux:file-item.remove wire:click="removeFile('{{ $name }}', {{ $multiple ? $i : 'null' }})" />
                            @endif
                        </x-slot>
                    </flux:file-item>
                @elseif($file->is_file)
                    <flux:file-item
                        :heading="___($file->name)"
                        :image="$file->image_url()"
                        :size="$file->info?->getSize()"
                    >
                        <x-slot name="actions">
                            @if ($can_delete)
                                <flux:file-item.remove wire:click="removeFile('{{ $name }}', {{ $multiple ? $i : 'null' }})" />
                            @endif
                        </x-slot>
                    </flux:file-item>
                @endif
            @endforeach
        </div>
    @endif
</flux:field>
