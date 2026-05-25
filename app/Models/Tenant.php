<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\TenantObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Override;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\TenantCollection;

#[ObservedBy(TenantObserver::class)]
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase;
    use HasDomains;
    use LogsActivity;
    use SoftDeletes;

    protected $keyType   = 'int';   // explicitly declare integer keys
    public $incrementing = true;  // ensures auto-increment behavior

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function getActivityLogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('tenant')
            ->logAll();
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'created_by',
            'data',
            'deleted_by',
            'name',
            'updated_by',
        ];
    }

    // Attributes
    protected function route(): Attribute
    {
        return new Attribute(static fn (): string => 'tenants.view');
    }

    #[Override]
    public function newCollection(array $models = []): TenantCollection
    {
        return new TenantCollection($models);
    }
}
