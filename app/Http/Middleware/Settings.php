<?php

namespace Fuse\Http\Middleware;

use Fuse\Helpers\Log;
use Fuse\Helpers\Settings as SettingsHelper;
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
