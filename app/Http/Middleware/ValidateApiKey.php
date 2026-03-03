<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request):Response $next
     */
    public function handle(Request $request, Closure $next)
    {
        $api_key = Str::replace('base64:', '', config('app.key'));

        if ($request->hasHeader('X-API-Key')) {
            // API key via X-API-Key
            $provided_key = $request->header('X-API-Key');

            if (!$provided_key || $provided_key !== $api_key) {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } elseif ($request->hasHeader('X-Hub-Signature-256')) {
            // API key via GitHub secret
            $incomingSignature = $request->header('X-Hub-Signature-256');
            $payload           = $request->getContent();

            if (!$incomingSignature) {
                return response()->json(['error' => 'Unauthorised'], 401);
            }

            $computedSignature = 'sha256='.hash_hmac('sha256', $payload, $api_key);

            if (!hash_equals($computedSignature, $incomingSignature)) {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        return $next($request);
    }
}
