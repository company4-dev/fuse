<?php

namespace Fuse\Traits;

use Exception;
use Fuse\Helpers\Activity;
use Fuse\Helpers\Cache;
use Fuse\Helpers\Collection;
use Fuse\Helpers\Dates;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait BaseModel
{
    protected static function booted(): void
    {
        static::addGlobalScope('default-sort', function (Builder $builder) {
            foreach (self::defaultSort() as $column => $order) {
                $builder->ordered($column, $order);
            }
        });
    }

    protected static function newFactory()
    {
        $model_class    = static::class;
        $model_basename = class_basename($model_class);

        // Extract namespace parts to build factory namespace
        $model_namespace   = substr($model_class, 0, strrpos($model_class, '\\'));
        $factory_namespace = str_replace('\\Models', '\\Database\\Factories', $model_namespace);
        $factory_class     = $factory_namespace.'\\'.$model_basename.'Factory';

        if (class_exists($factory_class)) {
            return $factory_class::new();
        }

        // Fallback to default Laravel factory location
        $default_factory_class = 'Database\\Factories\\'.$model_basename.'Factory';
        if (class_exists($default_factory_class)) {
            return $default_factory_class::new();
        }

        throw new Exception('Factory not found for model: '.$model_class);
    }

    // Attributes
    public function createdAtFormatted(): Attribute
    {
        return new Attribute(fn () => is_null($this->created_at) ? false : Dates::datetime($this->created_at));
    }

    public function createdByName(): Attribute
    {
        return Cache::attribute(fn () => Cache::hasColumn($this->getTable(), 'created_by')
            ? Cache::user($this->created_by)->name
            : null);
    }

    public function onboardingComplete(): Attribute
    {
        return Attribute::make(fn () => (bool) $this->onboarding_progress)->shouldCache();
    }

    public function updatedAtFormatted(): Attribute
    {
        return new Attribute(fn () => is_null($this->updated_at) ? false : Dates::datetime($this->updated_at));
    }

    public function updatedByName(): Attribute
    {
        return Cache::attribute(fn () => Cache::hasColumn($this->getTable(), 'updated_by')
            ? Cache::user($this->updated_by)->name
            : null);
    }

    // Methods
    public function log(string $message, array $args = [])
    {
        return Activity::log($message, $this, $args);
    }

    // Generate random hex based on current database values
    public function next_hex_id(Model $model, string $column = 'id', int $length = 6): mixed
    {
        if (!Cache::hasColumn($model->table, $column)) {
            return false;
        }

        $get_hex_id = fn () => strtoupper(str_pad(base_convert(random_int(1, (32 ** $length - 1)), 10, 32), $length, 0, STR_PAD_LEFT));

        $hex_id = $get_hex_id();

        while ($model->where($column, $hex_id)->count()) {
            $hex_id = $get_hex_id();
        }

        return $hex_id;
    }

    public function next_reference(string $reference, string $column = 'reference', ?string $separator = null): mixed
    {
        if (!Cache::hasColumn($this->table, $column)) {
            return false;
        }

        $increment          = '';
        $original_reference = Str::slug($reference);

        $get_reference = function () use ($original_reference, &$increment, $separator) {
            $reference = $original_reference.($increment ? $separator.$increment : '');

            $increment = is_numeric($increment) ? $increment + 1 : 1;

            return $reference;
        };

        $reference = $get_reference();

        while ($this->where($column, $reference)->count()) {
            $reference = $get_reference();
        }

        return $reference;
    }

    public function nice_date(string $column)
    {
        if ($this->$column !== null) {
            if (gettype($this->$column) === 'object' && $this->$column::class === Carbon::class) {
                $value = $this->$column->getTimestamp();
            } else {
                $value = $this->$column;
            }

            return Dates::date($value);
        }

        return false;
    }

    public function nice_datetime(string $column)
    {
        if ($this->$column !== null) {
            if (gettype($this->$column) === 'object' && $this->$column::class === Carbon::class) {
                $value = $this->$column->getTimestamp();
            } else {
                $value = $this->$column;
            }

            return Dates::datetime($value);
        }

        return false;
    }

    public function time_ago(string $column)
    {
        if ($this->$column !== null) {
            if (gettype($this->$column) === 'object' && $this->$column::class === Carbon::class) {
                $value = $this->$column->format('Y-m-d H:i:s');
            } else {
                $value = $this->$column;
            }

            return Dates::time_ago($value);
        }

        return false;
    }

    // Relations
    public function jellyBeanHasManyThrough(
        $through,
        $target,
        $this_primary_key,
        $though_foreign_key_for_this,
        $though_foreign_key_for_target,
        $target_primary_key,
    ): HasManyThrough {
        // https://www.laravelia.com/post/laravel-9-has-many-through-eloquent-relationship-tutorial
        return $this->hasManyThrough(
            $target,
            $through,
            $though_foreign_key_for_this,
            $target_primary_key,
            $this_primary_key,
            $though_foreign_key_for_target,
        );
    }

    // Scopes
    public function scopeActive(Builder $query, $active_status_id = 1)
    {
        return $query->where('status', $active_status_id);
    }

    public function scopeByUser(Builder $query, int $user_id)
    {
        $query->when(
            Cache::hasColumn($this->getTable(), 'user_id'),
            fn ($query) => $query->where('user_id', $user_id)
        );
    }

    public function scopeFindOrRedirect(Builder $query, $id, string $redirect, $columns = ['*'])
    {
        return $query->findOr(
            $id,
            $columns,
            fn () => App::abort(
                302,
                headers: [
                    'Location' => $redirect,
                ]
            )
        );
    }

    public function scopeFirstOrRedirect(Builder $query, $redirect = null, $columns = ['*'])
    {
        $result = $query->first($columns);

        if ($result) {
            return $result;
        }

        App::abort(
            302,
            headers: [
                'Location' => $redirect,
            ]
        );
    }

    public function scopeGetLimited(Builder $query, $limit = null)
    {
        return $query->limited($limit)->get();
    }

    public function scopeGetOrdered(Builder $query, $column = 'name', $order = 'asc')
    {
        $order = strtolower($order);
        $table = $this->getTable();

        if (!Cache::hasColumn($table, $column)) {
            return $query->get();
        }

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        return $query->get()->sortBy($column, SORT_FLAG_CASE | SORT_NATURAL, $order === 'desc')->values();
    }

    public function scopeLimited(Builder $query, $limit = null)
    {
        $query->limit($limit ?? config('settings.lists.items-per-page'));
    }

    public function scopeOrdered(Builder $query, $column = 'name', $order = 'asc')
    {
        $order = strtolower($order);
        $table = $this->getTable();

        if (!Cache::hasColumn($table, $column)) {
            return $query;
        }

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        return $query
            ->orderByRaw('CAST('.$column.' AS UNSIGNED) '.$order)
            ->orderBy($column, $order);
    }

    public function scopeSearch(Builder $query, ?string $term = null, ?array $fields = null)
    {
        if (!$term) {
            return $query;
        }

        if (!$fields) {
            $fields = $this->search_fields;

            if (!$fields) {
                throw new Exception(___('errors.exceptions.traits.model.no-search-fields', [self::class]));
            }

            if (!is_array($fields)) {
                throw new Exception(___('errors.exceptions.traits.model.invalid-search-fields'));
            }
        }

        $query->where(function ($query) use (&$fields, $term) {
            foreach ($fields as &$field) {
                if (is_array($field)) {
                    $concat  = 'CONCAT(`';
                    $concats = [];

                    foreach ($field as $v) {
                        $as_at = strpos($v, ' as');

                        if ($as_at !== false) {
                            $v = substr($v, 0, $as_at);
                        }

                        if (!str_contains($v, '.')) {
                            $concats[] = $v;
                        } else {
                            [$table, $v] = explode('.', $v);
                            $concats[]   = $table.'`.`'.$v;
                        }
                    }

                    $concat .= implode("`,' ',`", $concats);
                    $concat .= '`)';
                    $field = $concat;
                } else {
                    $as_at = strpos($field, ' as');

                    if ($as_at !== false) {
                        $field = substr($field, 0, $as_at);
                    }

                    if (!str_contains($field, '.')) {
                        $field = '`'.$field.'`';
                    } else {
                        [$table, $field] = explode('.', $field);
                        $field           = '`'.$table.'`.`'.$field.'`';
                    }
                }

                $query->orWhereRaw($field.' like ?', ['%'.$term.'%']);
            }
        });

        foreach ($fields as $field) {
            $query->orderByRaw(
                'LOCATE(?,'.$field.') > 0 DESC, LOCATE(?,'.$field.'), '.$field,
                [
                    str_replace('%', '', $term),
                    str_replace('%', '', $term),
                ]
            );
        }

        return $query;
    }

    public function scopeWhereMorph(Builder $query, string $column_prefix, string $type, int|string $id)
    {
        $query->where([
            $column_prefix.'_type' => $type,
            $column_prefix.'_id'   => $id,
        ]);
    }

    public function scopeWherePlatform(Builder $query, array|null|string $platform = null)
    {
        if ($platform === null) {
            $query->whereNull('platform');
        } elseif (is_array($platform)) {
            $query->whereIn('platform', $platform);
        } else {
            $query->where('platform', $platform);
        }
    }

    // Parent Extensions
    // Extend the default collection with custom methods
    public function newCollection(array $models = []): EloquentCollection
    {
        return new Collection($models);
    }

    public function save(array $options = [])
    {
        $table   = $this->getTable();
        $user_id = Auth::id() ?? 1;

        if (Cache::hasColumn($table, 'created_by') && !$this->created_by) {
            $this->created_by = $user_id;
        }

        if (Cache::hasColumn($table, 'updated_by') && !$this->updated_by) {
            $this->updated_by = $user_id;
        }

        foreach ($this->attributes as $field => $value) {
            if (in_array($field, ['created_at_formatted', 'deleted_at_formatted', 'updated_at_formatted'])
                && !Cache::hasColumn($table, $field)
            ) {
                unset($this->attributes[$field]);
            }
        }

        return parent::save($options);
    }

    protected static function defaultSort(): array
    {
        return [
            'name' => 'asc',
        ];
    }

    abstract protected function route(): Attribute;
}
