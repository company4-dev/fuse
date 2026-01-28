<?php

use Livewire\Livewire;

it('can render', function () {
    $component = Livewire::test('search');

    $component->assertSee('');
});
