<?php

namespace App\Observers;

use App\Models\Setting;
use App\Traits\BaseObserver;

class SettingObserver
{
    use BaseObserver;

    public function created(Setting $setting): void
    {
        $setting->log(
            'logs.setting.created',
            [
                $setting->name,
            ]
        );
    }

    public function updated(Setting $setting): void
    {
        $changes = $this->changes($setting);
        if ($changes) {
            $setting->log(
                'logs.setting.updated',
                [
                    $setting->name,
                    '- '.implode('<br>- ', array_column($changes, 'text')),
                ]
            );
        }
    }

    public function deleted(Setting $setting): void
    {
        $setting->log(
            'logs.setting.deleted',
            [
                $setting->name,
            ]
        );
    }

    public function restored(Setting $setting): void
    {
        $setting->log(
            'logs.setting.restored',
            [
                $setting->name,
            ]
        );
    }

    public function forceDeleted(Setting $setting): void
    {
        $setting->log(
            'logs.setting.permanently-deleted',
            [
                $setting->name,
            ]
        );
    }
}
