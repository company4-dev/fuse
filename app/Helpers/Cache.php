<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\User;
use Closure;
use DateInterval;
use DateTimeInterface;
use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache as LaravelCache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ReflectionFunction;
use ReflectionMethod;

class Cache
{
    private static $cache_keys            = [];
    private static array $cache_key_parts = ['jellybean', 'cache_keys', true];
    private static array $caches          = [];
    private static $db_columns            = [];
    private static int $dev_ttl           = Dates::DAY_IN_SECONDS;
    private static ?string $version       = null;

    public static function get_cache_keys()
    {
        return self::$cache_keys;
    }

    public static function attribute(callable $get_callback, ?callable $set_callback = null): Attribute
    {
        $attribute  = Str::snake(trace(3)[2]['function']);
        $id         = null;
        $model      = null;
        $reflection = new ReflectionFunction($get_callback);

        $model = $reflection->getClosureThis();

        [$table, $key, $id] = self::normaliseKey(
            $model->getTable(),
            'attributes',
            $model->getRawOriginal('id')
                .':'.$attribute
                .':'.($model->getOriginal('updated_at')->timestamp ?? $reflection->getStartLine())
        );

        $originals = $model->getRawOriginal();

        return new Attribute(
            static fn () => self::forever(
                $table,
                $key,
                $id,
                static fn () => $get_callback($originals[$attribute] ?? null)
            ),
            $set_callback
        );
    }

    public static function exists($model, $key = null, $id = null)
    {
        return LaravelCache::has(self::getKey($model, $key, $id));
    }

    public static function find($model, $key, $id = 1, $default = null)
    {
        return LaravelCache::get(self::getKey($model, $key, $id), $default);
    }

    /**
     * @return mixed[]
     */
    public static function findAll($model, $key = '*', $id = '*'): array
    {
        $caches = [];

        foreach (self::findAllKeys($model, $key, $id) as $key) {
            $caches[$key] = LaravelCache::get($key);
        }

        return $caches;
    }

    /**
     * @return mixed[]
     */
    public static function findAllKeys($model, $key = '*', $id = '*'): array
    {
        $formatted_key = self::getKey($model, $key, $id);
        $keys          = [];

        [$model, $key, $id] = self::normaliseKey($model, $key ?? '*', $id ?? '*');

        if (self::exists($model, $key, $id)) {
            $keys[] = $formatted_key;
        } else {
            foreach (self::$cache_keys as $key) {
                if (fnmatch($formatted_key, $key)) {
                    $keys[] = $key;
                }
            }
        }

        return $keys;
    }

    public static function forever($model, $key, $id = 1, $callback = null)
    {
        return LaravelCache::remember(self::getKey($model, $key, $id), Dates::MONTH_IN_SECONDS, $callback);
    }

    public static function forget(mixed $model = '*', $key = '*', $id = '*'): bool
    {
        if (gettype($model) === 'object') {
            $model = $model->getTable();
        } elseif (str_contains($model, '\\')) {
            $model = app($model)->getTable();
        }

        $formatted_key = self::getKey($model, $key, $id);
        $updated       = false;

        // If the passed key exists as is
        if (self::exists($model, $key, $id)) {
            if (array_key_exists($formatted_key, self::$caches)) {
                unset(self::$caches[$formatted_key]);
            }

            if (($array_key = array_search($formatted_key, self::$cache_keys, true)) !== false) {
                unset(self::$cache_keys[$array_key]);
            }

            LaravelCache::forget($formatted_key);

            $updated = true;
        } else {
            $keys = self::$cache_keys;

            foreach (self::$cache_keys as $i => $k) {
                if (fnmatch($formatted_key, $k)) {
                    LaravelCache::forget($k);

                    unset($keys[$i]);

                    $updated = true;
                }
            }
        }

        if ($updated) {
            LaravelCache::forget($formatted_key);
            LaravelCache::forget(self::getKey(...self::$cache_key_parts));

            self::$cache_keys = self::forever(
                self::$cache_key_parts[0],
                self::$cache_key_parts[1],
                self::$cache_key_parts[2],
                static fn () => self::$cache_keys
            );
        }

        return true;
    }

    public static function forgetAttributes($model, $id = 1, ...$attributes): void
    {
        if (gettype($model) === 'object') {
            $model = $model->getTable();
        } elseif (str_contains($model, '\\')) {
            $model = app($model)->getTable();
        } elseif (!Schema::hasTable($model)) {
            throw new Exception('Invalid cache model `'.$model.'`');
        }

        foreach ($attributes as $attribute) {
            [$model, $key, $id] = self::normaliseKey($model, 'attributes', $id.':'.$attribute.'*');
            $keys               = self::findAll($model, $key, $id);

            foreach (array_keys($keys) as $formatted_key) {
                self::forget(...explode('.', $formatted_key));
            }
        }
    }

    public static function forDays($model, $key, $id = 1, $callback = null, int $days = 1)
    {
        return self::forHours($model, $key, $id, $callback, 24 * $days);
    }

    public static function forHours($model, $key, $id = 1, $callback = null, int $hours = 1)
    {
        return self::forMinutes($model, $key, $id, $callback, 60 * $hours);
    }

    public static function forMinutes($model, $key, $id = 1, $callback = null, int $minutes = 1)
    {
        return self::remember(self::getKey($model, $key, $id), 60 * $minutes, $callback);
    }

    public static function forWeeks($model, $key, $id = 1, $callback = null, int $weeks = 1)
    {
        return self::forDays($model, $key, $id, $callback, 7 * $weeks);
    }

    public static function hasColumn($table, $column)
    {
        $key_parts = ['horizon', 'database', 'columns'];

        // If no active cache, populate from file cache
        if (!isset(self::$db_columns)) {
            self::$db_columns = self::find(...array_merge($key_parts, [[]]));
        }

        // If table doesn't exist in cache initialise it
        if (!array_key_exists($table, self::$db_columns)) {
            self::$db_columns[$table] = [];
        }

        // If column doesn't exist in cache initialise it
        if (!array_key_exists($column, self::$db_columns[$table])) {
            self::$db_columns[$table][$column] = Schema::hasColumn($table, $column);
            self::forget(...$key_parts);
            self::forever(...array_merge($key_parts, [static fn () => self::$db_columns[$table]]));
        }

        return self::$db_columns[$table][$column];
    }

    public static function remember(string $key, Closure|DateTimeInterface|DateInterval|int|null $ttl, $callback = null)
    {
        if (is_dev()) {
            $ttl = self::$dev_ttl;
        }

        self::cache_key($key);

        if (!array_key_exists($key, self::$caches)) {
            self::$caches[$key] = LaravelCache::remember($key, $ttl, $callback);
        }

        return self::$caches[$key];
    }

    public static function ui()
    {
        return self::forHours(
            'ui',
            'cache',
            1,
            static function (): array {
                $caches = [];

                foreach (get_class_methods(self::class) as $method) {
                    if (str_starts_with($method, 'ui_')) {
                        $check = new ReflectionMethod(self::class, $method);

                        if ($check->isPrivate()) {
                            $caches[str_replace('ui_', '', $method)] = self::$method();
                        }
                    }
                }

                return $caches;
            }
        );
    }

    public static function user(?int $id)
    {
        return is_null($id)
            ? null
            : self::forever(
                'User',
                'model',
                $id,
                static fn () => User::withoutGlobalScope('excluding-automation')->find($id)
            );
    }

    public static function version(): string
    {
        if (self::$version === null) {
            self::$version = trim(Storage::disk('root')->get('storage/app/version.txt'));
        }

        return self::$version;
    }

    public static function getKeys()
    {
        return LaravelCache::get(self::getKey(...self::$cache_key_parts));
    }

    public static function getKey($model, $key = '*', $id = '*'): string
    {
        return implode('.', self::normaliseKey($model, $key, $id));
    }

    // Helpers
    private static function cache_key(string $key): void
    {
        // If no active cache, populate from file cache
        if (!isset(self::$cache_keys)) {
            self::$cache_keys = self::find(...array_merge(self::$cache_key_parts, [[]]));
        }

        // If key doesn't exist in cache initialise it
        if (!in_array($key, self::$cache_keys, true)) {
            self::forget(...self::$cache_key_parts);

            self::$cache_keys[] = $key;

            sort(self::$cache_keys);

            self::forever(...array_merge(self::$cache_key_parts, [static fn () => self::$cache_keys]));
        }
    }

    private static function normaliseKey($model, $key = '*', $id = '*'): array
    {
        if (gettype($model) === 'object') {
            $model = $model->getTable();
        } elseif (str_contains($model, '\\')) {
            $model = app($model)->getTable();
        }

        return [Str::snake($model), Str::snake($key), Str::snake((string) $id)];
    }
}
