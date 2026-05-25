<?php

declare(strict_types=1);

namespace App\Helpers;

class GitHub
{
    public static function is_push(?string $x_github_event_header = null): bool
    {
        return $x_github_event_header ?? (request()->header('X-GitHub-Event') === 'push');
    }
}
