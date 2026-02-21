<?php

use App\Helpers\Storage;
use App\Helpers\Testing;
use App\Traits\BaseLivewireForm;

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Forms'))
    ->toBeClasses()
    ->toUseTrait(BaseLivewireForm::class);

test('Should not use setModel method on forms', function () {
    $base_path  = Storage::disk('root')->path('');
    $files      = glob($base_path.'{resources,Platforms/*/resources}/views/livewire/{*,**/*}.blade.php', GLOB_BRACE);
    $violations = [];

    foreach ($files as $file) {
        $lines = file($file, FILE_IGNORE_NEW_LINES);

        foreach ($lines as $line_number => $line) {
            if (str_contains($line, '$this->form->setModel')) {
                $violations[] = sprintf(
                    '	%d. %s, Line %d',
                    count($violations) + 1,
                    str_replace($base_path, '', $file),
                    $line_number + 1,
                );
            }
        }
    }

    if ($violations) {
        sort($violations);

        test()->fail('Found setModel usage, use `$this->form->model` instead in files:'."\r\n".implode("\r\n", $violations));
    }

    expect($violations)->toBeEmpty();
});
