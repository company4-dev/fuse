<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\Models\User;
use App\View\Forms\Users\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

new class extends Component
{
    public Profile $form;
    public User $user;

    public function mount()
    {
        $this->user = Auth::user();

        $this->form->model($this->user);

        $this->layout(
            [
                'users' => 'dictionary.users',
                $this->user->name,
            ],
            $this->user->avatar,
        );
    }

    public function submit()
    {
        $this->form->process(
            $this,
            function ($validated) {
                $this->user->email      = $validated['email'];
                $this->user->first_name = $validated['first_name'];
                $this->user->last_name  = $validated['last_name'];
                $this->user->password   = Hash::make($validated['new_password']);

                $this->user->save();

                return $this->redirect(route('profile'));
            },
            error: function ($validator, $data) {
                $this->form->reset([
                    'existing_password',
                    'new_password',
                    'new_password_confirmation',
                ]);
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
