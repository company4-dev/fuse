<?php

namespace App\Observers;

use App\Models\Schedule;
use App\Traits\BaseObserver;

class ScheduleObserver
{
    use BaseObserver;

    public function created(Schedule $schedule): void
    {
        $schedule->log(
            'logs.schedule.created',
            [
                $schedule->assignee->name,
            ]
        );
    }

    public function updated(Schedule $schedule): void
    {
        $changes = $this->changes($schedule);
        if ($changes) {
            $schedule->log(
                'logs.schedule.updated',
                [
                    $schedule->assignee->name,
                    '- '.implode('<br>- ', array_column($changes, 'text')),
                ]
            );
        }
    }

    public function deleted(Schedule $schedule): void
    {
        $schedule->log(
            'logs.schedule.deleted',
            [
                $schedule->assignee->name,
            ]
        );
    }

    public function restored(Schedule $schedule): void
    {
        $schedule->log(
            'logs.schedule.restored',
            [
                $schedule->assignee->name,
            ]
        );
    }

    public function forceDeleted(Schedule $schedule): void
    {
        $schedule->log(
            'logs.schedule.permanently-deleted',
            [
                $schedule->assignee->name,
            ]
        );
    }
}
