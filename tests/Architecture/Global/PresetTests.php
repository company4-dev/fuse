<?php

use App\Helpers\Code;
use App\Helpers\Log;
use App\Helpers\Testing;

// Presets
arch()->preset()->laravel()->ignoring([
    Code::class,
    Testing::class,
]);
arch()->preset()->php()->ignoring([
    Code::class,
    Log::class,
    Testing::class,
]);
arch()->preset()->security();
