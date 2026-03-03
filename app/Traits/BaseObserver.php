<?php

namespace App\Traits;

use App\Helpers\Cache;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait BaseObserver
{
    protected function changes($model, ?array $key_map = null, ?array $value_map = null)
    {
        $changes = [];

        foreach ($model->getChanges() as $column => $new_value) {
            if (!in_array($column, ['created_at', 'created_by', 'last_login', 'updated_at', 'updated_by'])) {
                $from = $model->getOriginal($column);
                $name = Str::headline($column);

                if (is_array($from)) {
                    $new_froms = array_diff(Arr::flatten($from), Arr::flatten(json_decode($new_value, true)));
                    $new_tos   = array_diff(Arr::flatten($from), Arr::flatten(json_decode($new_value, true)));

                    foreach ($new_froms as $key => $new_from) {
                        $to = $new_tos[$key];

                        $changes[$column] = [
                            'text' => $name.' > '.Str::headline($key).': "'
                                .(is_bool($new_from) ? ___($new_from ? 'dictionary.yes' : 'dictionary.no') : (string) $new_from)
                                .'" to "'
                                .(is_bool($to) ? ___($to ? 'dictionary.yes' : 'dictionary.no') : (string) $to).'"',
                            'to' => $to,
                        ];
                    }

                    continue;
                }

                if ($key_map && array_key_exists($column, $key_map)) {
                    $name = $key_map[$column];
                }

                if ($value_map && array_key_exists($column, $value_map)) {
                    $from         = $value_map[$column]($from);
                    $mapped_value = $value_map[$column]($new_value);
                } else {
                    $mapped_value = $new_value;
                }

                $changes[$column] = [
                    'text'   => $name.': "'.$from.'" to "'.$mapped_value.'"',
                    'to'     => $mapped_value,
                    'to-raw' => $new_value,
                ];
            }
        }

        return $changes;
    }

    protected function clearCaches($model): void
    {
        if ($model) {
            Cache::forget($model, '*', $model->id);
        }
    }
}
