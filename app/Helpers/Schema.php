<?php

namespace Fuse\Helpers;

use Closure;
use Illuminate\Support\Facades\Schema as BaseSchema;
use Illuminate\Support\Facades\Storage;
use Nwidart\Modules\Laravel\Module;

class Schema extends BaseSchema
{
    public static function create(string $table, Closure $callback)
    {
        parent::create(self::getPlatformTable($table), $callback);
    }

    public static function dropIfExists(string $table)
    {
        parent::dropIfExists(self::getPlatformTable($table));
    }

    public static function getPlatformTable($table)
    {
        $trace         = Code::trace(2)[1];
        $relative_file = str_replace(Storage::disk('platforms')->path(''), '', $trace['file']);
        [$platform]    = explode('/', $relative_file);

        $platform = Platforms::find($platform);

        if ($platform instanceof Module) {
            $table = $platform->getLowerName().'__'.$table;
        }

        return $table;
    }

    public static function table(string $table, Closure $callback)
    {
        parent::table(self::getPlatformTable($table), $callback);
    }
}
