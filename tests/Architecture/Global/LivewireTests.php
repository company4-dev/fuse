<?php

declare(strict_types=1);

use App\Helpers\Testing;

test('Should not use `$this->form->setModel`', function (): void {
    Testing::find_usage(
        '$this->form->setModel',
        '{resources,Platforms/*/resources}/views/pages/{*,**/*}.blade.php',
        'Found setModel usage, use `$this->form->model` instead.'
    );
})
->throwsNoExceptions();

test('Should not use `Livewire\WithFileUploads`', function (): void {
    Testing::find_usage(
        'use Livewire\WithFileUploads',
        '{resources,Platforms/*/resources}/views/pages/{*,**/*}.blade.php',
        'Call to parent::__construct() is missing from class constructor.'
    );
})
->throwsNoExceptions();
