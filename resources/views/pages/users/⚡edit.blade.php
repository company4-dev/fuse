<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\Models\User;
use App\View\Forms\Users\User as UserForm;

new class extends Component
{
    public UserForm $form;
    public User $user;

    public function mount($id)
    {
        $this->user = User::find($id);

        $this->form->model($this->user);

        $this->layout(
            [
                'users'                       => 'dictionary.users',
                'users.view:'.$this->user->id => $this->user->name,
                'dictionary.edit',
            ],
            $this->user->avatar,
        );
    }

    public function submit()
    {
        $this->form->process($this, function ($validated) {
            $this->user->first_name = $validated['first_name'];
            $this->user->role_id    = $validated['role_id'];
            $this->user->last_name  = $validated['last_name'];

            $this->user->save();

            return $this->redirect(route('users.view', $this->user->id));
        });
    }
};
?>

<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
