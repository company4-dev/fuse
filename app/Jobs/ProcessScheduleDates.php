<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Base\Job;
use App\Helpers\Log;
use App\Helpers\Platforms;
use App\Models\ScheduleDate;
// use App\Models\Tenant;
use Throwable;

class ProcessScheduleDates extends Job
{
    public int $date_id;
    public int $tenant_id;

    public function __construct(int $date_id, int $tenant_id)
    {
        $this->date_id   = $date_id;
        $this->tenant_id = $tenant_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $class     = null;
        $date      = ScheduleDate::find($this->date_id);
        $platform  = null;
        $schedule  = $date->schedule;
        // $tenant    = Tenant::find($this->tenant_id);
        $today     = today();
        $yesterday = $today->subDay();

        $class    = $schedule->generates;
        $platform = Platforms::getFromClass($schedule->assignee_type);

        // If disabled, mark as processed so it doesn't come back again next time this is run.
        if ($platform && $platform->isDisabled()) {
            $date->processed = true;
            $date->save();
        }

        if ($class) {
            try {
                $generated                  = $class::create($schedule->getMeta()->toArray());
                $date->generated_id         = $generated->id;
                $date->generated_type       = $class;
            } catch (Throwable $t) {
                $message = 'Unable to generate scheduled item: '.$t->getMessage();

                Log::error($message);

                $schedule->end_date = $yesterday->format('Y-m-d');

                $schedule->save();
            }
        }

        // Mark as processed even if it fails, the log will make the error "visible".
        $date->processed = true;

        $date->save();
    }
}
