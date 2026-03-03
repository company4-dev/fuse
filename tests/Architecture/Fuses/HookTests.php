<?php

use App\Helpers\Testing;
use App\Traits\BaseHookForm;
use App\Traits\BaseFuseHook;

arch()
    ->expect(Testing::wildcard_to_array('Fuses\*\Hooks'))
    ->toBeClasses()
    ->toUseTrait(BaseFuseHook::class)
    ->ignoring(Testing::wildcard_to_array('Fuses\*\Hooks\Forms'));

arch()
    ->expect(Testing::wildcard_to_array('Fuses\*\Hooks\Forms\*'))
    ->toBeClasses()
    ->toUseTrait(BaseHookForm::class);
