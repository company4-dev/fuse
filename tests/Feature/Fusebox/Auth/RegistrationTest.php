<?php

use Livewire\Livewire;

beforeEach()->todo('Check if registration is enabled, if not skip these tests');

test('registration screen can be rendered', function (): void {
    $this
        ->get('/register')
        ->assertStatus(200);
});

test('new users can register', function (): void {
    $response = Livewire::test('pages::auth.register')
        ->set('first_name', 'Test')
        ->set('last_name', 'User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});
