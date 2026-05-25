<?php

use App\Base\SSOServiceProvider;

arch()
    ->expect('App\Providers\SSO')
    ->toBeClasses()
    ->toExtend(SSOServiceProvider::class);
