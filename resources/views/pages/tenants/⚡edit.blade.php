<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Models\Tenant;
use App\View\Forms\Tenants\Edit;

new class extends Component
{
    public Edit $form;
    public Tenant $tenant;

    public function mount($id)
    {
        $this->tenant = Tenant::find($id);

        $this->form->model($this->tenant);

        $this->layout(
            [
                'tenants'                         => 'dictionary.tenants',
                'tenants.view:'.$this->tenant->id => $this->tenant->name,
                'dictionary.edit',
            ],
            Icons::tenant(),
        );
    }

    public function submit()
    {
        $this->form->process($this, function ($validated) {
            $this->tenant->name = $validated['name'];

            $this->tenant->save();

            return $this->redirect(route('tenants'));
        });
    }
};
?>

<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
