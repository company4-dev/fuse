<?php

namespace App\Observers;

use App\Models\ScheduleDate;
use App\Traits\BaseObserver;

class ScheduleDateObserver
{
    use BaseObserver;

    public function created(ScheduleDate $schedule_date): void
    {
        $schedule_date->log(
            'logs.schedule-date.created',
            [
                $schedule_date->schedule->assignee->name,
            ]
        );
    }

    public function updated(ScheduleDate $schedule_date): void
    {
        $changes = $this->changes($schedule_date);
        if ($changes) {
            $schedule_date->log(
                'logs.schedule-date.updated',
                [
                    $schedule_date->schedule->assignee->name,
                    '- '.implode('<br>- ', array_column($changes, 'text')),
                ]
            );
        }
    }

    public function deleted(ScheduleDate $schedule_date): void
    {
        $schedule_date->log(
            'logs.schedule-date.deleted',
            [
                $schedule_date->schedule->assignee->name,
            ]
        );
    }

    public function restored(ScheduleDate $schedule_date): void
    {
        $schedule_date->log(
            'logs.schedule-date.restored',
            [
                $schedule_date->schedule->assignee->name,
            ]
        );
    }

    public function forceDeleted(ScheduleDate $schedule_date): void
    {
        $schedule_date->log(
            'logs.schedule-date.permanently-deleted',
            [
                $schedule_date->schedule->assignee->name,
            ]
        );
    }
}
