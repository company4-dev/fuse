<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\PlatformServiceProvider;

// Settings-based providers are loaded via the AppServiceProvider's register method.

return array_filter([
    AppServiceProvider::class,
    PlatformServiceProvider::class,
]);
