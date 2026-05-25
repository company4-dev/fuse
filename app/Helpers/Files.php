<?php

declare(strict_types=1);

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SplFileInfo;
use stdClass;

class Files
{
    /**
     * Returns a path based off a passed id. Making it easier to navigate folder structures
     * Updated 19/08/2020 12:54
     */
    public static function id_path(int|string $id, int $split_length = 1): string
    {
        return implode('/', str_split((string) $id, $split_length)).'/';
    }

    public static function info(string $path): stdClass
    {
        if (!is_file($path)) {
            throw new Exception('File `'.$path.'` not found');
        }

        $file = [];
        $spl  = new SplFileInfo($path);

        foreach (get_class_methods($spl) as $method) {
            if (str_starts_with($method, 'get')
                && !in_array($method, ['getLinkTarget', 'getFileInfo', 'getPathInfo'], true)
            ) {
                $file[Str::camel(str_replace('get', '', $method))] = $spl->$method();
            }
        }

        $file['hex']         = Conversions::to_base_64($file['mTime']);
        $file['storagePath'] = str_replace(Storage::path(''), '', $file['realPath']);

        ksort($file);

        return (object) $file;
    }

    /**
     * Returns the correct path depending on calling function.
     */
    public static function tmp_path(): string
    {
        return sys_get_temp_dir().'/';
    }
}
