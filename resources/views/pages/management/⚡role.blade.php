<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Models\Role;
use Livewire\Attributes\Locked;

new class extends Component
{
    public array $details;

    #[Locked]
    public Role $role;

    #[Locked]
    public $tabs;

    public function mount($id)
    {
        $this->role = Role::findOrRedirect($id, 'management.roles');

        $this->tabs = [
            [
                'icon'  => Icons::permissions(),
                'label' => 'dictionary.permissions',
            ],
        ];

        $this->layout(
            [
                'management'       => 'dictionary.management',
                'management.roles' => 'dictionary.roles',
                $this->role->name,
            ],
            Icons::role(),
            [
                [
                    'icon'  => Icons::edit(),
                    'label' => ['phrases.edit', ['dictionary.role']],
                    'route' => ['management.edit-role', $this->role->id],
                ],
            ]
        );
    }
};
?>

<div>
    <x-page-header
        :activity="$role"
        :charts="null"
        :$details
        :users="null"
    />

    <x-tabs :$tabs>
        <x-tab target="dictionary.permissions">
            <livewire:table :id="$role->id" lazy table="permissions" />
        </x-tab>
    </x-tabs>
</div>
