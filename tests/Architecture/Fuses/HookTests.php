<?php

use App\Helpers\Testing;
use App\Traits\BaseFuseHook;
use App\Traits\BaseHookForm;

arch()
    ->expect(Testing::wildcard_to_array('Fuses\*\Hooks'))
    ->toBeClasses()
    ->toUseTrait(BaseFuseHook::class)
    ->ignoring(Testing::wildcard_to_array('Fuses\*\Hooks\Forms'));

arch()
    ->expect(Testing::wildcard_to_array('Fuses\*\Hooks\Forms\*'))
    ->toBeClasses()
    ->toUseTrait(BaseHookForm::class);
