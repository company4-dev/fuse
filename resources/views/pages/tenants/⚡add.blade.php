<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Mail\NewTenant;
use App\Models\Tenant;
use App\View\Forms\Tenants\Add;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

new class extends Component
{
    public Add $form;

    public function mount()
    {
        $this->layout(
            [
                'tenants' => 'dictionary.tenants',
                ['phrases.add', ['dictionary.tenant']],
            ],
            Icons::add()
        );
    }

    public function submit()
    {
         $me       = Auth::user();
        $password = '[Name]TheChicken';
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

        return $this->redirect(route('tenants'));
    }
};
?>

<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
