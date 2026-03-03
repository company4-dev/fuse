<?php

namespace App\Models;

use App\Observers\RoleObserver;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Models\Role as BaseRole;

#[ObservedBy(RoleObserver::class)]
class Role extends BaseRole
{
    use BaseModel;

    protected $fillable = [
        'color',
        'description',
        'guard_name',
        'locked',
        'name',
    ];

    protected function route(): Attribute
    {
        return new Attribute(fn () => ['management.role', $this->id]);
    }

    public function tableStatus(): Attribute
    {
        return new Attribute(
            get: fn () => [
                'color' => $this->color,
                'label' => $this->name,
            ],
        );
    }

    public function scopeLocked(Builder $query, bool $locked = true)
    {
        $query->where('locked', $locked);
    }
}
