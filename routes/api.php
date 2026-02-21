<?php

use App\Http\Controllers\API\PlatformsController;
use App\Http\Middleware\ValidateApiKey;
use Illuminate\Support\Facades\Route;

// Route::post('/platform/{platform}/update', function (Request $request, string $platform) {
//     return json_encode([$platform]);
// });

Route
    ::middleware([ValidateApiKey::class])
    ->group(function () {
        Route::post('/platform/{platform}/update', [PlatformsController::class, 'update'])->name('platform.update');
    });
