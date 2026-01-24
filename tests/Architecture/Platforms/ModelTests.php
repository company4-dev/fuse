<?php

use App\Helpers\Testing;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

arch()
    ->expect(Testing::wildcard_to_array('Platforms\*\Models'))
    ->toBeClasses()
    ->toExtend(Model::class)
    ->toHaveAttribute(ObservedBy::class)
    ->toUseTrait(BaseModel::class);
