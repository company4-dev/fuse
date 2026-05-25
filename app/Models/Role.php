<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\RoleObserver;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Models\Role as BaseRole;

#[Fillable([
    'color',
    'description',
    'guard_name',
    'locked',
    'name',
])]
#[ObservedBy(RoleObserver::class)]
class Role extends BaseRole
{
    use BaseModel;

    protected function route(): Attribute
    {
        return new Attribute(fn (): array => ['management.role', $this->id]);
    }

    public function tableStatus(): Attribute
    {
        return new Attribute(
            get: fn (): array => [
                'color' => $this->color,
                'label' => $this->name,
            ],
        );
    }

    public function scopeLocked(Builder $query, bool $locked = true): void
    {
        $query->where('locked', $locked);
    }
}
