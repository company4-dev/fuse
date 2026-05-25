<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Models\Permission;
use App\Models\Role;
use App\View\Forms\Management\Role as RoleForm;
use Illuminate\Support\Arr;
use Livewire\Attributes\Locked;

new class extends Component
{
    public RoleForm $form;

    #[Locked]
    public $role;

    public function mount(int $id)
    {
        $this->role = Role::findOrRedirect($id, 'management.roles');

        $this->form->options = Permission::toSelect();
        $this->form->model($this->role);

        $this->layout(
            [
                'management'                       => 'dictionary.management',
                'management.roles'                 => 'dictionary.roles',
                'management.role:'.$this->role->id => $this->role->name,
                ['phrases.edit', ['dictionary.role']],
            ],
            Icons::role(),
        );
    }

    public function submit()
    {
        $this->form->process($this, function ($validated) {
            $permissions = Arr::flatten($validated['permissions'], 1);

            $this->role->permissions()->sync($permissions);

            return $this->redirect(route('management.roles'));
        });
    }
};
?>

<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
