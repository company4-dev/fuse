<?php

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

arch()
    ->expect('App\Models')
    ->toBeClasses()
    ->toExtend(Model::class)
    ->toHaveAttribute(ObservedBy::class)
    ->toUseTrait(BaseModel::class);
