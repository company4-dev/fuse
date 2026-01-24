<?php

use App\Models\User;

test('User can view management page', function () {
    $user = User::factory()->create([
        'email'      => 'some.tester@example.com',
        'first_name' => 'Some',
        'last_name'  => 'Tester',
    ]);

    $this->actingAs($user);

    visit('/app/management')
        ->screenshot()
        ->assertSee('Management');

    // Platforms
    visit('/app/management/platforms')
        ->screenshot()
        ->assertSee('Platforms');

    visit('/app/management/add-platform')
        ->screenshot()
        ->assertSee('Add Platform');

    // Users
    visit('/app/management/roles')
        ->screenshot()
        ->assertSee('Roles');
});
