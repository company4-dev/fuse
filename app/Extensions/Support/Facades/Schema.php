<?php

declare(strict_types=1);

namespace App\Extensions\Support\Facades;

use App\Helpers\Code;
use App\Helpers\Platforms;
use Closure;
use Illuminate\Support\Facades\Schema as BaseSchema;
use Illuminate\Support\Facades\Storage;
use Nwidart\Modules\Laravel\Module;

/**
 * Methods here cannot be loaded as a macro via the AppServiceProvider.
 */
class Schema extends BaseSchema
{
    public static function create(string $table, Closure $callback): void
    {
        parent::create(self::getPlatformTable($table), $callback);
    }

    public static function dropIfExists(string $table): void
    {
        parent::dropIfExists(self::getPlatformTable($table));
    }

    public static function getPlatformTable(string $table): string
    {
        $trace         = Code::trace(2)[1];
        $relative_file = str_replace(Storage::disk('platforms')->path(''), '', $trace['file']);
        [$platform]    = explode('/', $relative_file);

        $platform = Platforms::find($platform);

        if ($platform instanceof Module) {
            return $platform->getLowerName().'__'.$table;
        }

        return $table;
    }

    public static function table(string $table, Closure $callback): void
    {
        parent::table(self::getPlatformTable($table), $callback);
    }
}
