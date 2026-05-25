<?php

use App\Base\Enum;

arch()
    ->expect('App\Enums')
    ->toBeEnums()
    ->toUseTrait(Enum::class);
