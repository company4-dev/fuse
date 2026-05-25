<flux:modal class="min-w-[22rem]" :$name>
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ is_array($title) ? ___(...$title) : ___($title) }}</flux:heading>
        </div>

        {{ $slot }}

        @if (!($hideCancel ?? false))
            <div class="flex">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">{{ $cancelText ?? ___('dictionary.cancel') }}</flux:button>
                </flux:modal.close>
            </div>
        @endif
    </div>
</flux:modal>
