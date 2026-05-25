<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Models\User;
use App\View\Forms\Users\User as UserForm;

new class extends Component
{
    public UserForm $form;

    public function mount()
    {
        $this->layout(
            [
                'users' => 'dictionary.users',
                'dictionary.add',
            ],
            Icons::add(),
        );
    }

    public function submit()
    {
        $this->form->process($this, function ($validated) {
            $user = new User;

            $user->email      = $validated['email'];
            $user->first_name = $validated['first_name'];
            $user->last_name  = $validated['last_name'];
            $user->password   = bcrypt(now());
            $user->role_id    = $validated['role_id'];

            $user->save();

            return $this->redirect(route('users.view', $user->id));
        });
    }
};
?>

<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
