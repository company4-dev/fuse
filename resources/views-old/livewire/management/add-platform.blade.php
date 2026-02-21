<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\View\Forms\Management\Platform as PlatformForm;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

use function Livewire\Volt\form;
use function Livewire\Volt\mount;

form(PlatformForm::class);

mount(function () {
    Livewire::layout(
        [
            'dictionary.management',
            'management.platforms' => 'dictionary.platforms',
            ['phrases.add', ['dictionary.platform']],
        ],
        Icons::platform(),
    );
});

$submit = fn () => $this->form->process($this, function ($validated) {
    $name = Str::of($validated['name'])->studly()->toString();

    Process
        ::path('../')
        ->run('cd Platforms && git clone '.$validated['repository'].' '.$name);
}); ?>
<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
