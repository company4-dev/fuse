<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\View\Forms\Developer;
use Livewire\Attributes\Defer;

new #[Defer()] class extends Component
{
    public Developer $form;

    public function submit()
    {
        $this->form->process($this, fn ($validated) => $this->redirect(route($this->form->submit($validated))));
    }
}
?>

<flux:modal name="developer" class="w-full max-w-[30rem] my-[12vh] max-h-screen min-w-[22rem] overflow-y-hidden">
    <x-form :$form type="ungrouped" />
</flux:modal>
