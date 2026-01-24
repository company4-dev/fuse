<?php

use App\Helpers\Testing;
use App\Traits\BaseEnum;
use App\Traits\BasePermissionsEnum;

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Enums'))
    ->toBeEnums()
    ->toUseTrait(BaseEnum::class);

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Enums\Permissions'))
    ->toBeEnums()
    ->toUseTrait(BasePermissionsEnum::class);
