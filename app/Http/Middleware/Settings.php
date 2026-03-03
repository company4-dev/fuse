<?php

namespace App\Http\Middleware;

use App\Helpers\Log;
use App\Helpers\Settings as SettingsHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Settings
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request):Response $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            SettingsHelper::load();
        } catch (Throwable $throwable) {
            Log::emergency($throwable->getMessage());
        }

        return $next($request);
    }
}
