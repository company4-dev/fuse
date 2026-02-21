<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item :href="route('profile')" wire:navigate>
                {{ ___('dictionary.profile') }}
            </flux:navlist.item>

            <flux:navlist.item :href="route('settings.password')" wire:navigate>
                {{ ___('dictionary.password') }}
            </flux:navlist.item>

            <flux:navlist.item :href="route('settings.appearance')" wire:navigate>
                {{ ___('dictionary.appearance') }}
            </flux:navlist.item>
        </flux:navlist>
    </div>

    <flux:separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ ___($heading ?? '') }}</flux:heading>
        <flux:subheading>{{ ___($subheading ?? '') }}</flux:subheading>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
