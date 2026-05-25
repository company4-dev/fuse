<?php

declare(strict_types=1);

namespace App\Base;

use App\Helpers\Cache;
use App\Helpers\Log;
use App\Helpers\Notifications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Throwable;

abstract class Observer
{
    private string $feature;
    private ?string $platform = null;

    protected function changes(Model $model, ?array $key_map = null, ?array $value_map = null): array
    {
        $changes = [];

        foreach ($model->getChanges() as $column => $new_value) {
            if (!in_array($column, ['created_at', 'created_by', 'last_login', 'updated_at', 'updated_by'], true)) {
                $from = $model->getOriginal($column);
                $name = Str::headline($column);

                if ($key_map && array_key_exists($column, $key_map)) {
                    $name = $key_map[$column];
                }

                if (is_array($from)) {
                    $new_froms = array_diff(Arr::flatten($from), Arr::flatten(json_decode($new_value, true)));
                    $new_tos   = array_diff(Arr::flatten($from), Arr::flatten(json_decode($new_value, true)));

                    foreach ($new_froms as $key => $new_from) {
                        $to = $new_tos[$key];

                        if ($value_map && array_key_exists($column, $value_map)) {
                            if ($value_map[$column] === null) {
                                continue;
                            }

                            $from         = $value_map[$column]($from);
                            $mapped_value = $value_map[$column]($to);
                        } else {
                            $mapped_value = $to;
                        }

                        $changes[$column] = [
                            'text' => $name.' > '.Str::headline($key).' from "'
                                .(is_bool($new_from)
                                    ? ___($new_from ? 'dictionary.yes' : 'dictionary.no')
                                    : (string) $new_from)
                                .'" to "'
                                .(is_bool($to) ? ___($to ? 'dictionary.yes' : 'dictionary.no') : (string) $to).'"',
                            'to' => $to,
                        ];
                    }
                } else {
                    if ($value_map && array_key_exists($column, $value_map)) {
                        if ($value_map[$column] === null) {
                            continue;
                        }

                        $from         = $value_map[$column]($from);
                        $mapped_value = $value_map[$column]($new_value);
                    } else {
                        $mapped_value = $new_value;
                    }

                    $changes[$column] = [
                        'text'   => $name.' "'.$from.'" to "'.$mapped_value.'"',
                        'to'     => $mapped_value,
                        'to-raw' => $new_value,
                    ];
                }
            }
        }

        return $changes;
    }

    protected function clearCaches(Model $model): void
    {
        if ($model) {
            Cache::forget($model, '*', $model->id);
        }
    }

    private function init(Model $model): void
    {
        $class = explode('\\', $model::class);

        $this->feature  = Str::of(class_basename($model))->slug()->singular()->toString();
        $this->platform = $class[0] === config('modules.namespace') ? strtolower($class[1]) : null;
    }

    protected function run_created(
        Model $model,
        mixed $item_name,
        ?string $feature = null,
        string $action = 'created'
    ): void {
        $this->init($model);

        $translation = [
            ($this->platform ? $this->platform.'::' : '').'logs.'.($feature ?: $this->feature).'.'.$action,
            $item_name,
        ];

        $this->toast(...$translation);

        $model->log(...$translation);

        $this->clearCaches($model);
    }

    protected function run_deleted(
        Model $model,
        mixed $item_name,
        ?string $feature = null,
        string $action = 'deleted'
    ): void {
        $this->init($model);

        $translation = [
            ($this->platform ? $this->platform.'::' : '').'logs.'.($feature ?: $this->feature).'.'.$action,
            $item_name,
        ];

        $this->toast(...$translation);

        $model->log(...$translation);

        $this->clearCaches($model);
    }

    protected function run_force_deleted(
        Model $model,
        mixed $item_name,
        ?string $feature = null,
        string $action = 'permanently-deleted'
    ): void {
        $this->init($model);

        $translation = [
            ($this->platform ? $this->platform.'::' : '').'logs.'.($feature ?: $this->feature).'.'.$action,
            $item_name,
        ];

        $this->toast(...$translation);

        $model->log(...$translation);

        $this->clearCaches($model);
    }

    protected function run_restored(
        Model $model,
        mixed $item_name,
        ?string $feature = null,
        string $action = 'restored'
    ): void {
        $this->init($model);

        $translation = [
            ($this->platform ? $this->platform.'::' : '').'logs.'.($feature ?: $this->feature).'.'.$action,
            $item_name,
        ];

        $this->toast(...$translation);

        $model->log(...$translation);

        $this->clearCaches($model);
    }

    protected function run_updated(
        Model $model,
        mixed $item_name,
        ?string $feature = null,
        string $action = 'updated',
        array $value_map = []
    ): array {
        $changes = $this->changes($model, $value_map);

        if ($changes) {
            $this->init($model);

            $translation = [
                ($this->platform ? $this->platform.'::' : '').'logs.'.Str::plural($feature ?: $this->feature).'.'
                    .$action,
                [
                    'changes' => implode(', ', array_column($changes, 'text')),
                    'item'    => $item_name,
                ],
            ];

            $this->toast(...$translation);

            $model->log(...$translation);

            $this->clearCaches($model);
        }

        return $changes;
    }

    private function toast($translation, string|null|array|float $replacements): void
    {
        try {
            Notifications::toast($translation, variant: 'success', translation_replacements: $replacements);
        } catch (Throwable $throwable) {
            if (!App::runningUnitTests()) {
                Log::critical(
                    $throwable->getMessage(),
                    'This message should be shown to the user... somewhere: '.___($translation, $replacements)
                );
            } else {
                Log::error($throwable->getMessage());
            }
        }
    }
}
