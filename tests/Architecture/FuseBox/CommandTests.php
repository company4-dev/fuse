<?php

use App\Traits\BaseCommand;

arch()
    ->expect('App\Console\Commands')
    ->toBeClasses()
    ->toUseTrait(BaseCommand::class);
