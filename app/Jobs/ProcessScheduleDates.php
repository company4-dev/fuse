<?php

namespace App\Jobs;

use App\Helpers\Log;
use App\Helpers\Platforms;
use App\Models\ScheduleDate;
use App\Models\Tenant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

class ProcessScheduleDates implements ShouldQueue
{
    use Queueable;

    public $date;
    public $tenant;

    public function __construct(ScheduleDate $date, Tenant $tenant)
    {
        $this->date   = $date;
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $platform  = null;
        $schedule  = $this->date->schedule;
        $today     = today();
        $yesterday = $today->subDay();

        $platform = Platforms::getFromClass($schedule->assignee_type);

        // If disabled, mark as processed so it doesn't come back again next time this is run.
        if ($platform && $platform->isDisabled()) {
            $this->date->processed = true;
            $this->date->save();
        }

        if ($class = $schedule->generates) {
            try {
                $generated                  = $class::create($schedule->getMeta()->toArray());
                $this->date->generated_id   = $generated->id;
                $this->date->generated_type = $class;
            } catch (Throwable $t) {
                $message = 'Unable to generate scheduled item: '.$t->getMessage();

                Log::error($message);

                $schedule->end_date = $yesterday->format('Y-m-d');

                $schedule->save();
            }
        }

        // Mark as processed even if it fails, the log will make the error "visible".
        $this->date->processed = true;

        $this->date->save();
    }
}
