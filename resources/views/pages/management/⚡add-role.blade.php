<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Models\Role;
use App\View\Forms\Management\Role as RoleForm;

new class extends Component
{
    public RoleForm $form;

    public function mount()
    {
        $this->layout(
            [
                'management'       => 'dictionary.management',
                'management.roles' => 'dictionary.roles',
                ['phrases.add', ['dictionary.role']],
            ],
            Icons::role(),
        );
    }

    public function submit()
    {
        $this->form->process($this, function ($validated) {
            $role = Role::create($validated->toArray());

            return $this->redirect(route('management.role', $role->id));
        });
    }
};
?>
<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
