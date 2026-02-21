<?php

namespace App\Models;

use App\Enums\Permissions;
use App\Enums\TenantDisplay;
use App\Helpers\Cache;
use App\Helpers\Platforms;
use App\Helpers\Tenants;
use App\Observers\PermissionObserver;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Permission as BasePermission;

#[ObservedBy(PermissionObserver::class)]
class Permission extends BasePermission
{
    use BaseModel;

    // Attributes
    public function display(): Attribute
    {
        return new Attribute(fn () => $this->enum->display());
    }

    public function enum(): Attribute
    {
        return Cache::attribute(function () {
            $class = $this->platform ? Platforms::getNamespace($this->platform).'Enums\\Permissions' : Permissions::class;

            return $class::fromName($this->name);
        });
    }

    public function fixed(): Attribute
    {
        return new Attribute(fn () => $this->enum->fixed());
    }

    public function label(): Attribute
    {
        return new Attribute(fn () => $this->enum->label());
    }

    public function platformName(): Attribute
    {
        return new Attribute(fn () => $this->platform ? Platforms::find($this->platform)->getName() : ___('dictionary.jellybean'));
    }

    protected function route(): Attribute
    {
        return new Attribute(fn () => null);
    }

    // Methods
    public static function toSelect(bool $include_all = false): array
    {
        $is_tenant = Tenants::is_tenant();
        $return    = [];

        foreach (self::wherePlatform(Platforms::active()->pluck('StudlyName'))->orWhereNull('platform')->get() as $permission) {
            $add     = false;
            $display = $permission->display;

            if ($include_all) {
                $add = true;
            } elseif (($is_tenant && in_array($display, [TenantDisplay::Both, TenantDisplay::Tenant]))
                || (!$is_tenant && in_array($display, [TenantDisplay::Both, TenantDisplay::Central]))
            ) {
                $add = true;
            }

            if (!$add) {
                continue;
            }

            $return[$permission->platform_name][$permission->id] = [
                'disabled'    => $permission->fixed,
                'description' => $permission->label.'.description',
                'label'       => $permission->label.'.label',
            ];
        }

        return $return;
    }

    // Relations
    public function role_permissions(): BelongsTo
    {
        return $this->belongsTo(RolePermission::class, 'id', 'permission_id');
    }
}
