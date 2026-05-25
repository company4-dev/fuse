<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\Tenant;
use Exception;

class Tenants
{
    public static function end(): void
    {
        tenancy()->end();
    }

    public static function initialize($id): void
    {
        $tenant = self::find($id);

        if (!$tenant instanceof \Stancl\Tenancy\Contracts\Tenant) {
            throw new Exception(___('errors.exceptions.tenants.not-found'));
        }

        tenancy()->initialize($tenant);
    }

    public static function current()
    {
        return tenant();
    }

    public static function find($id): ?\Stancl\Tenancy\Contracts\Tenant
    {
        return tenancy()->find($id);
    }

    public static function id()
    {
        return self::current()?->id;
    }

    public static function is_tenant(): bool
    {
        return self::current() !== null;
    }

    public static function domain()
    {
        return self::current()?->domain;
    }

    public static function data(?string $key = null)
    {
        $tenant = self::current();

        if (!$tenant) {
            return null;
        }

        return $key ? $tenant->data[$key] ?? null : $tenant->data;
    }

    public static function each(callable $callback, bool $as_tenant = false, bool $include_core = false): void
    {
        $tenants = config('settings.tenancy.enabled') ? Tenant::all(['id'])->toArray() : [];

        if ($include_core) {
            $tenants[] = ['id' => null];
        }

        foreach ($tenants as $tenant) {
            if ($tenant['id'] !== null && $as_tenant) {
                tenancy()->initialize($tenant);
            }

            $callback(self::find($tenant['id']));

            if ($tenant['id'] !== null && $as_tenant) {
                tenancy()->end();
            }
        }
    }
}
