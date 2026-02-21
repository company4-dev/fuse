<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage as FacadesStorage;

class Storage extends FacadesStorage
{
    /**
     * Returns a path based off a passed id. Making it easier to navigate folder structures.
     */
    public static function id_path(string $id, int $split_length = 1): string
    {
        return implode('/', str_split($id, $split_length)).'/';
    }

    /**
     * Returns the correct path depending on calling function.
     */
    public static function tmp_path(): string
    {
        return sys_get_temp_dir().'/';
    }
}
