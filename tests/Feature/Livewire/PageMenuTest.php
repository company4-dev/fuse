<?php

declare(strict_types=1);

use Livewire\Livewire;

it('can render', function (): void {
    $component = Livewire::test('page-menu');

    $component->assertSee('');
})->skip('To Fix: `Unable to resolve dependency [Parameter #0 [ <required> $menu ]]`');
