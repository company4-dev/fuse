<?php

use Livewire\Livewire;

it('can render', function () {
    $component = Livewire::test('modal-confirm');

    $component->assertSee('');
});
