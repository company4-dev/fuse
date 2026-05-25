<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Helpers\Cache;
use App\Models\Activity;
use App\Models\User;

class ActivityObserver extends Observer
{
    public function created(Activity $activity): void
    {
        $this->clearActivityCaches($activity);
    }

    public function deleted(Activity $activity): void
    {
        $this->clearActivityCaches($activity);
    }

    public function forceDeleted(Activity $activity): void
    {
        $this->clearActivityCaches($activity);
    }

    public function restored(Activity $activity): void
    {
        $this->clearActivityCaches($activity);
    }

    // Helpers
    protected function clearActivityCaches($activity): void
    {
        $this->clearCaches($activity);

        if ($activity->causer_type === User::class) {
            Cache::forgetAttributes(User::class, $activity->causer_id, 'logs');
        }
    }
}
