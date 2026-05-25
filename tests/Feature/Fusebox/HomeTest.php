<?php

declare(strict_types=1);

test('Home page', function (): void {
    visit('/')
        ->screenshot()
        ->assertScreenshotMatches(true, true)
        ->assertNoSmoke()
        ->assertDontSee('dictionary.')
        ->assertDontSee('phrases.')
        ->assertSee('Hiya')
        ->click('Login')
        ->assertSee('Login');
})->todo('Fails when tenancy is disabled');
