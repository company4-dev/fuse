<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Helpers\Settings;
use Illuminate\Console\Events\CommandStarting;

class LoadConsoleSettings
{
    public function handle(CommandStarting $event): void
    {
        Settings::load();
    }
}
