<?php

namespace Fuse\Models;

use Exception;
use Fuse\Helpers\Log;
use Fuse\Observers\SettingObserver;
use Fuse\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

#[ObservedBy(SettingObserver::class)]
class Setting extends Model
{
    use BaseModel;
    use CentralConnection;

    public $timestamps  = false;
    protected $fillable = [
        'group',
        'name',
        'value',
    ];

    protected function route(): Attribute
    {
        return new Attribute(fn () => 'management.settings');
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
