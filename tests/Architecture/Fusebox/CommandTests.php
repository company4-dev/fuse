<?php

use App\Base\Command;

arch()
    ->expect('App\Console\Commands')
    ->toBeClasses()
    ->toExtend(Command::class);
