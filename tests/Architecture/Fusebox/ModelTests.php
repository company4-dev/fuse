<?php

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

beforeEach()->skip('Doesn\'t like wildcards');

arch()
    ->expect('App\Models')
    ->toBeClasses()
    ->toExtend(Model::class)
    ->toHaveAttribute(ObservedBy::class)
    ->toUseTrait(BaseModel::class);
