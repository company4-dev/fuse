<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;

// We have to use class-style the global updating for the filters
new class extends Component
{
    public function boot(): void
    {
        $notifications = Auth::user()->unreadNotifications;

        foreach ($notifications as $notification) {
            $link = $notification->data['link'];

            if ($link !== null && !str_starts_with($link, config('app.url'))) {
                $link = route($link);
            }

            Flux::toast(
                ___($notification->data['text'], $notification->data['translation_replacements']),
                heading: $notification->data['heading']
                    ? ___($notification->data['heading'], $notification->data['translation_replacements'])
                    : null,
                variant: $notification->data['variant'],
                position: $link,
            );

            $notification->update(['read_at' => now()]);
        }

        $this->dispatch('notifications-updated', Auth::user()->notifications->count());
    }
}

?>

<div wire:poll.15s>
    <flux:toast.group>
        <flux:toast />
    </flux:toast.group>
</div>
