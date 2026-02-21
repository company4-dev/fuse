<?php

namespace App\Jobs;

use App\Models\Schedule;
use App\Models\ScheduleDate;
use App\Models\Tenant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateScheduleDates implements ShouldQueue
{
    use Queueable;

    public $schedule;
    public $tenant;

    public function __construct(Schedule $schedule, Tenant $tenant)
    {
        $this->schedule = $schedule;
        $this->tenant   = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dates          = [];
        $items_per_page = config('settings.lists.items-per-page');

        if ($this->schedule->is_endless) {
            $dates_after_today = $this->schedule->dates_after_today;
            $last_date         = $this->schedule->last_date;

            if (!$last_date) {
                $dates[]   = $this->schedule->start_date;
                $last_date = $this->schedule->start_date;
            }

            // Bring the schedule up-to-date
            while (today()->parse($last_date)->timestamp <= today()->timestamp) {
                $last_date = $this->schedule->generate_next_date($last_date);
                $dates[]   = $last_date;
            }

            // Always have days in the future
            for ($i = $dates_after_today; $i < $items_per_page; $i++) {
                $last_date = $this->schedule->generate_next_date($last_date);
                $dates[]   = $last_date;
            }
        } elseif ($this->schedule->end_after !== null) {
            $last_date = $this->schedule->start_date;

            for ($i = 0; $i < $this->schedule->end_after; $i++) {
                $last_date = $this->schedule->generate_next_date($last_date);
                $dates[]   = $last_date;
            }
        } else {
            $last_date = $this->schedule->start_date;

            while (today()->parse($last_date)->timestamp <= today()->parse($this->schedule->end_date)->timestamp) {
                $last_date = $this->schedule->generate_next_date($last_date);

                if ($last_date) {
                    if (today()->parse($last_date)->timestamp <= today()->parse($this->schedule->end_date)->timestamp) {
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
                    'schedule_id' => $this->schedule->id,
                    'date'        => $date,
                ]);
            }
        }
    }
}
