<?php

declare(strict_types=1);

namespace App\Base;

use App\Helpers\Files;
use App\Models\User;
use App\Notifications\Toast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

abstract class Export implements ShouldAutoSize, ShouldQueue
{
    use Exportable;

    public function __construct(User $user, string $title)
    {
        $path = 'Exports/'.Files::id_path($user->id).$title.'_'.date('Y-m-d_H-i').'.xlsx';

        $this
            ->queue($path)
            ->chain(fn () => $user->notify(new Toast(
                'messages.features.exports.success',
                variant: 'success',
                translation_replacements: [$title],
                link: Storage::temporaryUrl($path, now()->plus(seconds: config('settings.notifications.lifetime')))
            )));
    }
}
