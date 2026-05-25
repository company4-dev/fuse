<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\File;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasFiles
{
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
