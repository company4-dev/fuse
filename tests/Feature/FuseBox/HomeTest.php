<?php

test('Home page', function () {
    visit('/')
        ->screenshot()
        ->assertScreenshotMatches(true, true)
        ->assertNoSmoke()
        ->assertDontSee('dictionary.')
        ->assertDontSee('phrases.')
        ->assertSee('Hiya')
        ->click('Login')
        ->assertSee('Login');
});
