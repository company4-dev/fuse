<?php

use App\Traits\BaseHook;

arch()
    ->expect('App\Hooks')
    ->toBeClasses()
    ->toUseTrait(BaseHook::class);
