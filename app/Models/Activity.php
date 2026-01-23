<?php

namespace Fuse\Models;

use Fuse\Helpers\Cache;
use Fuse\Observers\ActivityObserver;
use Fuse\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Models\Activity as BaseActivity;

#[ObservedBy(ActivityObserver::class)]
class Activity extends BaseActivity
{
    use BaseModel;

    protected $appends = [
        'causer_name',
    ];

    // Attributes
    public function causerName(): Attribute
    {
        return new Attribute(fn () => $this->causer_id ? Cache::user($this->causer_id)?->name : null);
    }

    public function description(): Attribute
    {
        return new Attribute(fn ($value) => ___($value, $this->properties->toArray()));
    }

    public function route(): Attribute
    {
        return new Attribute(fn () => $this->subject?->route);
    }

    protected static function defaultSort(): array
    {
        return [
            'created_at' => 'desc',
        ];
    }
}
