<?php

use Fuse\Providers\FuseServiceProvider;
use Fuse\Providers\PlatformServiceProvider;
use Fuse\Providers\TenancyServiceProvider;
use Fuse\Providers\VoltServiceProvider;

return [
    AppServiceProvider::class,
    PlatformServiceProvider::class,
    TenancyServiceProvider::class,
    VoltServiceProvider::class,
];
