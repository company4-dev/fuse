<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\Mail\NewTenant;
use App\View\Forms\Tenants\Add;
use Flux\Flux;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

new class extends Livewire
{

    public Add $form;

    public function mount()
    {
        Livewire::layout(
            [
                'tenants.list' => 'dictionary.tenants',
                ['phrases.add', ['dictionary.tenant']],
            ],
            Icons::add()
        );
    }

    public function submit(): void
    {
        $this->form->process(
            $this,
            function ($validated) {
                $me       = Auth::user();
                $password = 'WireMeUp';
                $tenant   = Tenant::create([
                    'name' => $validated['name'],
                ]);

                $tenant->domains()->create([
                    'domain' => strtolower($tenant->name),
                ]);

                Artisan::call('tenants:seed --tenants='.$tenant->id);

                Mail
                    ::to($me)
                    ->queue(new NewTenant(
                        $me,
                        [
                            'domain'   => $tenant->domains()->first()->url,
                            'email'    => 'support@jellyhaus.com',
                            'password' => $password,
                            'tenant'   => $tenant,
                        ]
                    ));

                Flux::toast(___('logs.tenant.created', [$tenant->name]), variant: 'success');

                return $this->redirect(route('tenants.list'));
            }
        );
    }
};
?>

<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
