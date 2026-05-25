<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Models\Tenant;

new class extends Component
{
    public array $details;
    public Tenant $tenant;

    public function mount($id)
    {
        $this->tenant = Tenant::find($id);

        $this->details = [
            [
                'icon'  => Icons::name(),
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
        ];

        $this->layout(
        [
            'tenants' => 'dictionary.tenants',
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
    }
};
?>

<div>
    <x-page-header
        :activity="$tenant"
        :charts="null"
        :$details
        :users="null"
    />

    @if ($tenant->domains->isNotEmpty())
        <flux:card>
            <flux:heading size="lg">{{ ___('dictionary.domains') }}</flux:heading>

            <livewire:table :id="$tenant->id" lazy table="tenants.domains" />
        </flux:card>
    @endif
</div>
