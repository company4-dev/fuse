<?php

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\FuseServiceProvider;
use App\Providers\TenancyServiceProvider;

return [
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    FuseServiceProvider::class,
    TenancyServiceProvider::class,
];
