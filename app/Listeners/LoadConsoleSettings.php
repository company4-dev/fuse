<?php

namespace Fuse\Listeners;

use Fuse\Helpers\Settings;
use Illuminate\Console\Events\CommandStarting;

class LoadConsoleSettings
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommandStarting $event)
    {
        Settings::load();
    }
}
