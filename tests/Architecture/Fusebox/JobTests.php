<?php

use App\Base\Job;

arch()
    ->expect('App\Jobs')
    ->toBeClasses()
    ->toExtend(Job::class);
