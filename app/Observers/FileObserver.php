<?php

namespace App\Observers;

use App\Helpers\Cache;
use App\Models\File;
use App\Models\User;
use App\Traits\BaseObserver;

class FileObserver
{
    use BaseObserver;

    public function created(File $file): void
    {
        $this->clearFileCaches($file);
    }

    public function updated(File $file): void
    {
        $changes = $this->changes($file);
        if ($changes) {
            $this->clearFileCaches($file);
        }
    }

    public function deleted(File $file): void
    {
        $this->clearFileCaches($file);
    }

    public function restored(File $file): void
    {
        $this->clearFileCaches($file);
    }

    public function forceDeleted(File $file): void
    {
        $this->clearFileCaches($file);
    }

    // Helpers
    protected function clearFileCaches($file): void
    {
        $this->clearCaches($file);

        match ($file->group) {
            'avatar' => Cache::forgetAttributes(User::class, $file->fileable_id, 'avatar'),
            default  => null,
        };
    }
}
