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

    // Fuses
    visit('/app/management/fuses')
        ->screenshot()
        ->assertSee('Fuses');

    visit('/app/management/add-fuse')
        ->screenshot()
        ->assertSee('Add Fuse');

    // Users
    visit('/app/management/roles')
        ->screenshot()
        ->assertSee('Roles');
});
