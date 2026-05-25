<?php

use App\Base\HookForm;
use App\Base\PlatformHook;
use App\Helpers\Testing;

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Hooks'))
    ->toBeClasses()
    ->toUseTrait(PlatformHook::class)
    ->ignoring(Testing::wildcard_to_array('Platforms\*\Hooks\Forms'));

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Hooks\Forms\*'))
    ->toBeClasses()
    ->toUseTrait(HookForm::class);
