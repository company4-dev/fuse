<?php

use App\Base\Hook;

arch()
    ->expect('App\Hooks')
    ->toBeClasses()
    ->toExtend(Hook::class);
