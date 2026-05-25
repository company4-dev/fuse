<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Helpers\Cache;
use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FileObserver extends Observer
{
    public function created(File $file): void
    {
        $this->process($file, 'uploaded');
    }

    public function updated(File $file): void
    {
        $changes = $this->changes($file);

        if ($changes) {
            $this->process($file, 'updated', $changes);
        }
    }

    public function deleted(File $file): void
    {
        $this->process($file, 'deleted');
    }

    public function restored(File $file): void
    {
        $this->process($file, 'restored');
    }

    public function forceDeleted(File $file): void
    {
        $this->process($file, 'permanently-deleted');
    }

    // Helpers
    private function process(Model $file, string $action, array $changes = []): void
    {
        $this->clearCaches($file);

        if ($file->group === 'avatar') {
            Cache::forgetAttributes(User::class, $file->fileable_id, 'avatar');
        }

        if ($file->model) {
            // Update model's updated_at
            $file->model->touch();

            // Add a log to the model
            $file->model->log(
                'logs.file.'.$action,
                [
                    'changes' => implode(', ', array_column($changes, 'text')),
                    'item'    => $file->name,
                ]
            );
        }
    }
}
