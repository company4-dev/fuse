<?php

namespace Fuse\Observers;

use Fuse\Helpers\Cache;
use Fuse\Models\File;
use Fuse\Models\User;
use Fuse\Traits\BaseObserver;

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
