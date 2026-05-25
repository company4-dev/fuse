<?php

use App\Base\Enum;
use App\Base\PermissionsEnum;
use App\Helpers\Testing;

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Enums'))
    ->toBeEnums()
    ->toUseTrait(Enum::class);

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Enums\Permissions'))
    ->toBeEnums()
    ->toUseTrait(PermissionsEnum::class);
