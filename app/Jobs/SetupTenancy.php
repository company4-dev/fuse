<?php

namespace Fuse\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;
use Stancl\Tenancy\Contracts\Tenant;

class SetupTenancy implements ShouldQueue
{
    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function handle()
    {
        $this->tenant->run(function ($tenant) {
            $storage_path = storage_path();

            // Create tenant-specific directories
            File::makeDirectory($storage_path.'/app/private', 0775, true, true);
            File::makeDirectory($storage_path.'/app/public', 0775, true, true);
            File::makeDirectory($storage_path.'/framework/cache', 0775, true, true);

            // Create the symlink
            $linkPath   = public_path('storage/'.$tenant->getTenantKey());
            $targetPath = storage_path('app/public');

            // Ensure parent directory for link exists and is writable
            if (!File::exists(dirname($linkPath))) {
                File::makeDirectory(dirname($linkPath), 0775, true, true);
            }

            // Remove existing link if it exists to avoid errors
            if (file_exists($linkPath) || is_link($linkPath)) {
                unlink($linkPath);
            }

            // Create the new symlink
            File::link($targetPath, $linkPath);
        });
    }
}
