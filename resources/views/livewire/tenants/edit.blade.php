<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\Models\Tenant;
use App\View\Forms\Tenants\Edit;
use Flux\Flux;

use function Livewire\Volt\form;
use function Livewire\Volt\mount;
use function Livewire\Volt\state;

form(Edit::class);

mount(function ($id) {
    $this->tenant = Tenant::find($id);

    $this->form->model($this->tenant);

    Livewire::layout(
        [
            'tenants.list'                    => 'dictionary.tenants',
            'tenants.view:'.$this->tenant->id => $this->tenant->name,
            'dictionary.edit',
        ],
        Icons::tenant(),
    );
});

state([
    'tenant' => null,
]);

$submit = fn () => $this->form->process($this, function ($validated) {
    $this->tenant->name = $validated['name'];

    $this->tenant->save();

    Flux::toast(___('logs.tenant.updated', [$this->tenant->name]), variant: 'success');

    return $this->redirect(route('tenants.list'));
});

?>

<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
