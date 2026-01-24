<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\Models\Tenant;

use function Livewire\Volt\mount;
use function Livewire\Volt\state;

mount(function ($id) {
    $this->tenant = Tenant::find($id);

    Livewire::layout(
        [
            'tenants.list' => 'dictionary.tenants',
            $this->tenant->name,
        ],
        Icons::tenant(),
        [
            [
                'icon'  => Icons::edit(),
                'label' => ['phrases.edit', ['dictionary.tenant']],
                'route' => ['tenants.edit', $this->tenant->id],
            ],
        ]
    );
});

state([
    'tenant' => null,
]);

?>

<div>
    <x-page-header
        :activity="null"
        :charts="null"
        :details="[
            [
                'icon'  => Icons::tenant(),
                'label' => 'dictionary.name',
                'value' => $tenant->name,
            ],
            [
                'icon'  => Icons::reference(),
                'label' => 'dictionary.id',
                'value' => $tenant->id,
            ],
            [
                'icon'  => Icons::link(),
                'label' => 'dictionary.domains',
                'value' => $tenant->domains()->count(),
            ],
        ]"
        right-title="// Something Else"
    >
        Content for something else
    </x-page-header>

    @if ($tenant->domains->isNotEmpty())
        <flux:card>
            <flux:heading size="lg">{{ ___('dictionary.domains') }}</flux:heading>

            <livewire:table :id="$tenant->id" lazy table="tenants.domains" />
        </flux:card>
    @endif
</div>
