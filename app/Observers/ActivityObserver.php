<?php

namespace Fuse\Observers;

use Fuse\Helpers\Cache;
use Fuse\Models\Activity;
use Fuse\Models\User;
use Fuse\Traits\BaseObserver;

class ActivityObserver
{
    use BaseObserver;

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
