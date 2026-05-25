<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\View\Forms\Auth\ResetPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

new class extends Component
{
    public ResetPassword $form;

    public function mount(string $token)
    {
        $this->layout();

        $this->form->email = request()->string('email');
        $this->form->token = $token;
    }

    public function render()
    {
        return $this->view()->layout('layouts::auth');
    }

    public function submit()
    {
        $this->form->process($this, function ($validated) {
            /**
             * Here we will attempt to reset the user's password. If it is successful we will update the password on an
             * actual user model and persist it to the database. Otherwise we will parse the error and return the
             * response.
             */
            $status = Password::reset(
                $this->form->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($validated) {
                    $user->forceFill([
                        'password'       => Hash::make($validated['password']),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($user));
                }
            );

            /**
             * If the password was successfully reset, we will redirect the user back to the application's home
             * authenticated view. If there is an error we can redirect them back to where they came from with their
             * error message.
             */
            if ($status !== Password::PasswordReset) {
                $this->addError('email', ___($status));

                return;
            }

            Session::flash('status', ___($status));

            $this->redirectRoute('login', navigate: true);
        });
    }
};
?>

<div class="container">
    @if (session('status'))
        <x-callout variant="success">
            {{ session('status') }}
        </x-callout>
    @endif

    <flux:card>
        <flux:heading class="text-center mb-3" size="lg">
            {{ ___('phrases.reset-password') }}
        </flux:heading>

        <x-separator />

        <x-form :$form type="ungrouped" />
    </flux:card>
</div>
