<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;
use App\Helpers\Tenants;
use App\Jobs\GenerateScheduleDates;
use App\Jobs\ProcessScheduleDates;
use App\Models\Schedule;
use App\Models\ScheduleDate;
use Illuminate\Database\Eloquent\Builder;

class ProcessScheduleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes the items within the `schedules` database table';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->generate_dates();
        $this->process_dates();

        return Command::SUCCESS;
    }

    private function generate_dates(): void
    {
        // Load schedules with a start date of today or before
        $this->info('1. Generating new schedule dates');
        $this->info(' 1.1. Loading schedules');

        Tenants::each(
            function ($tenant): void {
                $schedules = Schedule
                    // Where schedule is today or in the past and...
                    ::where(static function (Builder $query): void {
                        $query
                            ->where(static function (Builder $query): void {
                                // ...is endless
                                $query
                                    ->whereNull('end_date')
                                    ->whereNull('end_after');
                            })
                            // ...or dateless (I.e. we haven't processed it yet)
                            ->orWhereDoesntHave('dates');
                    })
                    ->get();

                if ($schedules->isNotEmpty()) {
                    $this->info(' 1.2. Processing '.number_format($schedules->count()).' schedules.');

                    $progress = $this->output->createProgressBar($schedules->count());

                    $progress->start();

                    foreach ($schedules as $schedule) {
                        GenerateScheduleDates::dispatch($schedule->id, $tenant->id);

                        $progress->advance();
                    }

                    $progress->finish();

                    $this->info('');
                }
            },
            true,
            true
        );

        $this->info(' 1.3. Finished generating new schedule dates');
    }

    private function process_dates(): void
    {
        $this->info('2. Processing schedule dates');
        $this->info(' 2.1. Loading schedule dates');

        $today      = today();
        $next_month = $today->add(1, 'month');

        Tenants::each(
            function ($tenant) use ($today, $next_month): void {
                $dates = ScheduleDate
                    ::whereDate('date', $next_month->format('Y-m-d'))
                    ->whereHas(
                        'schedule',
                        static function (Builder $query) use ($today): void {
                            $query
                                ->whereDate('start_date', '<=', $today->format('Y-m-d'))
                                ->where(static function (Builder $query): void {
                                    $query
                                        ->where(static function (Builder $query): void {
                                            // ...is endless
                                            $query
                                                ->whereNull('end_date')
                                                ->whereNull('end_after');
                                        })
                                        // ...or dateless (I.e. we haven't processed it yet)
                                        ->orWhereDoesntHave('dates');
                                });
                        }
                    )
                    ->orWhere(static function (Builder $query) use ($next_month): void {
                        $query
                            ->whereDate('date', '<', $next_month->format('Y-m-d'))
                            ->where('processed', false);
                    })
                    ->get();

                if ($dates->isNotEmpty()) {
                    $this->info(' 2.2. Processing '.number_format($dates->count()).' schedules.');

                    $progress = $this->output->createProgressBar($dates->count());

                    $progress->start();

                    foreach ($dates as $date) {
                        ProcessScheduleDates::dispatch($date->id, $tenant->id);

                        $progress->advance();
                    }

                    $progress->finish();

                    $this->info('');
                }
            },
            true,
            true
        );

        $this->info(' 2.3. Finished processing schedule dates');
    }
}
