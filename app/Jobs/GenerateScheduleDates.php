<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Base\Job;
use App\Models\Schedule;
// use App\Models\Tenant;
use App\Models\ScheduleDate;

class GenerateScheduleDates extends Job
{
    public int $schedule_id;
    public int $tenant_id;

    public function __construct(int $schedule_id, int $tenant_id)
    {
        $this->schedule_id = $schedule_id;
        $this->tenant_id   = $tenant_id;
    }

    /**
     * Execute the job.
     */
    public function handle(int ...$ids): void
    {
        $dates          = [];
        $items_per_page = config('settings.lists.items-per-page');
        $schedule       = Schedule::find($this->schedule_id);
        // $tenant         = Tenant::find($this->tenant_id);

        if ($schedule->is_endless) {
            $dates_after_today = $schedule->dates_after_today;
            $last_date         = $schedule->last_date;

            if (!$last_date) {
                $dates[]   = $schedule->start_date;
                $last_date = $schedule->start_date;
            }

            // Bring the schedule up-to-date
            while (today()->parse($last_date)->timestamp <= today()->timestamp) {
                $last_date = $schedule->generate_next_date($last_date);
                $dates[]   = $last_date;
            }

            // Always have days in the future
            for ($i = $dates_after_today; $i < $items_per_page; $i++) {
                $last_date = $schedule->generate_next_date($last_date);
                $dates[]   = $last_date;
            }
        } elseif ($schedule->end_after !== null) {
            $last_date = $schedule->start_date;

            for ($i = 0; $i < $schedule->end_after; $i++) {
                $last_date = $schedule->generate_next_date($last_date);
                $dates[]   = $last_date;
            }
        } else {
            $last_date = $schedule->start_date;

            while (today()->parse($last_date)->timestamp <= today()->parse($schedule->end_date)->timestamp) {
                $last_date = $schedule->generate_next_date($last_date);

                if ($last_date) {
                    if (today()->parse($last_date)->timestamp <= today()->parse($schedule->end_date)->timestamp) {
                        $dates[] = $last_date;
                    }
                } else {
                    break;
                }
            }
        }

        foreach ($dates as $date) {
            if ($date) {
                ScheduleDate::firstOrcreate([
                    'schedule_id' => $schedule->id,
                    'date'        => $date,
                ]);
            }
        }
    }
}
