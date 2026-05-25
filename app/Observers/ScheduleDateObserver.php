<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Models\ScheduleDate;

class ScheduleDateObserver extends Observer
{
    public function created(ScheduleDate $schedule_date): void
    {
        $this->run_created($schedule_date, $schedule_date->schedule->assignee->name);
    }

    public function deleted(ScheduleDate $schedule_date): void
    {
        $this->run_deleted($schedule_date, $schedule_date->schedule->assignee->name);
    }

    public function forceDeleted(ScheduleDate $schedule_date): void
    {
        $this->run_force_deleted($schedule_date, $schedule_date->schedule->assignee->name);
    }

    public function restored(ScheduleDate $schedule_date): void
    {
        $this->run_restored($schedule_date, $schedule_date->schedule->assignee->name);
    }

    public function updated(ScheduleDate $schedule_date): void
    {
        $this->run_updated($schedule_date, $schedule_date->schedule->assignee->name);
    }
}
