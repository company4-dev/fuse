<?php

use Livewire\Volt\Component;

new class extends Component
{
    //
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="___('dictionary.appearance')">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ ___('dictionary.light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ ___('dictionary.dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ ___('dictionary.system') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>
