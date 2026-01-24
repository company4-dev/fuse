<?php

use App\Helpers\Testing;
use App\Traits\BaseHookForm;
use App\Traits\BasePlatformHook;

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Hooks'))
    ->toBeClasses()
    ->toUseTrait(BasePlatformHook::class)
    ->ignoring(Testing::wildcard_to_array('Platforms\*\Hooks\Forms'));

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Hooks\Forms\*'))
    ->toBeClasses()
    ->toUseTrait(BaseHookForm::class);
