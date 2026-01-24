<?php

namespace Fuse\Composer;

use Composer\Script\Event;

class Hooks
{
    public static function postInstall(Event $event)
    {
        // Run anything you want here
        // e.g. generate config, cache modules, publish assets
        \Fuse\Helpers\Log::info([
            'Remove all config files.'
        ]);

        self::postUpdate($event);
    }

    public static function postUpdate(Event $event)
    {
        // Same idea, but for updates
    }

}
