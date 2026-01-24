<?php

use App\Models\User;

test('User can edit profile', function () {
    $user = User::factory()->create([
        'email'      => 'some.tester@example.com',
        'first_name' => 'Some',
        'last_name'  => 'Tester',
    ]);
    $this->actingAs($user);

    visit('/app/profile')
        ->screenshot()
        ->assertScreenshotMatches(true, true)
        ->assertSee('First Name');
});
