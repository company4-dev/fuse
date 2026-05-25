<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Base\Job;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class GenerateImages extends Job
{
    public function __construct(
        private readonly string $disk,
        private readonly string $path
    ) {}

    public function handle(): void
    {
        $disk         = Storage::disk($this->disk);
        $path         = Str::chopEnd($this->path, 'original.png');
        $storage_path = $disk->path($path);

        ImageManager
            ::gd()
            ->read($disk->path($this->path))
            ->scaleDown(1920, 1080)
            ->save($storage_path.'large.png')
            ->scaleDown(500)
            ->save($storage_path.'medium.png')
            ->cover(100, 100)
            ->save($storage_path.'thumb.png');
    }
}
