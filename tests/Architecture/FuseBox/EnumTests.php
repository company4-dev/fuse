<?php

use App\Traits\BaseEnum;

arch()
    ->expect('App\Enums')
    ->toBeEnums()
    ->toUseTrait(BaseEnum::class);
