<?php

use Livewire\Livewire;

it('can render', function () {
    $component = Livewire::test('page-menu');

    $component->assertSee('');
});
