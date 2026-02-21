<?php

namespace App\Helpers;

class Routes
{
    public static function make(array|string|null $route)
    {
        $parameters = null;
        $platform   = null;

        if (is_numeric($route) || is_null($route)) {
            return null;
        }

        if (is_string($route)) {
            if (str_contains($route, '::')) {
                [$platform, $route] = explode('::', $route);
            }

            if (str_contains($route, ':')) {
                [$route, $parameters] = explode(':', $route);

                $parameters = explode(',', $parameters);
            }

            if ($platform) {
                $route = implode('::', [$platform, $route]);
            }
        } else {
            $parameters = $route[1];
            $route      = $route[0];
        }

        return route($route, $parameters ?? []);
    }
}
