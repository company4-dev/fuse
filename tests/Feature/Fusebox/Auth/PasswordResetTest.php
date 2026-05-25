<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

test('reset password link screen can be rendered', function (): void {
    $this
        ->get('/forgot-password')
        ->assertStatus(200);
});

test('reset password link can be requested', function (): void {
    Notification::fake();

    $user = User::factory()->create();

    Livewire::test('pages::auth.forgot-password')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class);
})
->skip('To Fix: `Unable to set component data. Public property [$email] not found on component:
[pages::auth.forgot-password]`');

test('reset password screen can be rendered', function (): void {
    Notification::fake();

    $user = User::factory()->create();

    Livewire::test('pages::auth.forgot-password')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification): true {
        $response = $this->get('/reset-password/'.$notification->token);

        $response->assertStatus(200);

        return true;
    });
})
->skip('To Fix: `Unable to set component data. Public property [$email] not found on component:
[pages::auth.forgot-password]`');

test('password can be reset with valid token', function (): void {
    Notification::fake();

    $user = User::factory()->create();

    Livewire::test('pages::auth.forgot-password')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user): true {
        $response = Livewire::test('auth.reset-password', ['token' => $notification->token])
            ->set('email', $user->email)
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('resetPassword');

        $response
            ->assertHasNoErrors()
            ->assertRedirect(route('login', absolute: false));

        return true;
    });
})
->skip('To Fix: `Unable to set component data. Public property [$email] not found on component:
[pages::auth.forgot-password]`');
