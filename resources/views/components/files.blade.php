@use('App\Helpers\Conversions')
@use('App\Models\File')

@if ($files)
    @php
        $canDelete  = isset($canDelete) && filter_var($canDelete, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $card_class = 'basis-[200px] mb-3 me-3';
        $quote      = [
            "\r\n\tEgg #1: \"I'm telling you, that cow had my name on it.\"\r\n\tMoulder,\r\n\tX-Files\r\n",
            "\r\n\tEgg #2: \"The truth is out there, but so are lies.\"\r\n\tScully,\r\n\tX-Files\r\n"
        ][mt_rand(0, 1)];
    @endphp
    <!-- {!! $quote !!} -->
    <div class="flex flex-wrap">
        @php
            if (!is_array($files) && $files::class === File::class) {
                $files = [$files];
            }
        @endphp

        @foreach ($files as $file)
            @if ($file && $file->is_file)
                @php
                    $class = $card_class;
                    $name  = '';

                    if (isset($file->name)) {
                        $name = $file->name;
                    } elseif ($file->is_image) {
                        $name = str_replace('-thumb', '', $file->base_name);
                    } else {
                        $name = $file->base_name;
                    }
                @endphp

                @if ($file->id)
                    <a
                        aria-label="{{ ___('dictionary.download') }}"
                        class="{{ $class }}"
                        href="{{ $file->download_link }}"
                        target="_blank"
                    >
                @endif
                <flux:card :class="($file->id ? null : $class).' flex flex-col gap-3 items-center p-3'">
                    @if (!$file->is_image || $file->encrypted === true)
                        <x-icon :file-extension="$file->extension" size="12" />
                    @elseif ($file->is_image)
                        <img
                            alt="{{ ___($name) }}"
                            src="{{ $file->image_url() }}"
                        >
                    @endif
                    <span class="text-truncate">{{ ___($name) }}</span>
                </flux:card>
                @if ($file->id)
                    </a>
                @endif
            @endif
        @endforeach
    </div>
@endif
