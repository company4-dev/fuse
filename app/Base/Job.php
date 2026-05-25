<?php

declare(strict_types=1);

namespace App\Base;

use App\Helpers\Log;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

abstract class Job implements ShouldBeEncrypted, ShouldQueue
{
    use Queueable;

    public int $tries = 10;

    public function backoff()
    {
        // Exponential backoff: 1s, 5s, 15s, 30s, 1min, 2min, 5min, 10min, 30min, 60min
        return [1, 5, 15, 30, 60, 120, 300, 600, 1_800, 3_600];
    }

    public function failed(Throwable $exception): void
    {
        Log::error('Job permanently failed: '.$exception->getMessage());
    }
}
