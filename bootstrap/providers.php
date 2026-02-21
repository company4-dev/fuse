<?php

use App\Providers\FuseServiceProvider;
use App\Providers\TenancyServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    FuseServiceProvider::class,
    TenancyServiceProvider::class,
];
