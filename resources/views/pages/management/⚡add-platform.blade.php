<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\View\Forms\Management\Platform as PlatformForm;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

new class extends Component
{
    public PlatformForm $form;

    public function mount()
    {
        $this->layout(
            [
                'management'           => 'dictionary.management',
                'management.platforms' => 'dictionary.platforms',
                ['phrases.add', ['dictionary.platform']],
            ],
            Icons::platform(),
        );
    }

    public function submit()
    {
        $this->form->process($this, function ($validated) {
            $name = Str::of($validated['name'])->studly()->toString();

            Process
                ::path('../')
                ->run('cd Platforms && git clone '.$validated['repository'].' '.$name);
        });
    }
};
?>
<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
