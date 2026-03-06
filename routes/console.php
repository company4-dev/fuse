<?php

use Illuminate\Support\Facades\Schedule;

// Hourly
Schedule::command('schedule:process')->hourly()->withoutOverlapping();

// Daily
Schedule::command('backup:incremental')->withoutOverlapping()->cron('0 06,12,18 * * *');

// Daily At Midnight
// Always backup first
Schedule::command('backup:full')->withoutOverlapping()->daily();
Schedule::command('activitylog:clean --force')->withoutOverlapping()->daily();
