<?php

namespace Fuse\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Activity
{
    public static function log(string $message, ?Model $model = null, ?array $properties = null)
    {
        $activity = activity()->causedBy(Auth::user() ?? Cache::user(1));

        if ($properties) {
            $activity->withProperties($properties);
        }

        if ($model instanceof Model) {
            $activity->performedOn($model);
        }

        $activity->log($message);

        return $activity;
    }
}
