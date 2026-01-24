<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('page-menu');

    $component->assertSee('');
});
