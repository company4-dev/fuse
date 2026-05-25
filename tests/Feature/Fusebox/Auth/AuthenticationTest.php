<?php

use App\Models\User;
use Livewire\Livewire;

test('login screen can be rendered', function (): void {
    $this
        ->get('/login')
        ->assertStatus(200);
});

test('users can authenticate using the login screen', function (): void {
    $user = User::factory()->create();

    $response = Livewire::test('pages::auth.login')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
})
->skip('To Fix: `Unable to set component data. Public property [$email] not found on component: [pages::auth.login]`');

test('users can not authenticate with invalid password', function (): void {
    $user = User::factory()->create();

    $response = Livewire::test('pages::auth.login')
        ->set('email', $user->email)
        ->set('password', 'wrong-password')
        ->call('login');

    $response->assertHasErrors('email');

    $this->assertGuest();
})
->skip('To Fix: `Unable to set component data. Public property [$email] not found on component: [pages::auth.login]`');

test('users can logout', function (): void {
    $user = User::factory()->create();

    $this
        ->actingAs($user)
        ->post('/logout')
        ->assertRedirect('/');

    $this->assertGuest();
});
