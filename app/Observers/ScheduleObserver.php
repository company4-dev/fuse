<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Models\Schedule;

class ScheduleObserver extends Observer
{
    public function created(Schedule $schedule): void
    {
        $this->run_created($schedule, $schedule->assignee->name);
    }

    public function deleted(Schedule $schedule): void
    {
        $this->run_deleted($schedule, $schedule->assignee->name);
    }

    public function forceDeleted(Schedule $schedule): void
    {
        $this->run_force_deleted($schedule, $schedule->assignee->name);
    }

    public function restored(Schedule $schedule): void
    {
        $this->run_restored($schedule, $schedule->assignee->name);
    }

    public function updated(Schedule $schedule): void
    {
        $this->run_updated($schedule, $schedule->assignee->name);
    }
}
