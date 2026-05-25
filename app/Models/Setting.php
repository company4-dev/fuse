<?php

declare(strict_types=1);

namespace App\Models;

use App\Helpers\Log;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

#[Fillable([
    'group',
    'name',
    'value',
])]
class Setting extends Model
{
    use BaseModel;
    use CentralConnection;

    public $timestamps  = false;

    protected function route(): Attribute
    {
        return new Attribute(static fn (): string => 'management.settings');
    }

    // Scopes
    public function scopeFormatted(Builder $query): array
    {
        $db_settings = [];
        $settings    = [];

        try {
            $db_settings = $query->get();
        } catch (Exception $exception) {
            Log::debug($exception->getMessage());
        }

        foreach ($db_settings as $setting) {
            $settings[$setting->group][$setting->name] = $setting->value;
        }

        return $settings;
    }
}
