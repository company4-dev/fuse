<?php

namespace Fuse\Models;

use Fuse\Observers\RolePermissionObserver;
use Fuse\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(RolePermissionObserver::class)]
class RolePermission extends Model
{
    use BaseModel;

    protected function route(): Attribute
    {
        return new Attribute(fn () => null);
    }
}
