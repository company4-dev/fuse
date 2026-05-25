<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\Notifications\Toast;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

new class extends Component
{
    public ?Collection $notifications = null;

    public function delete(string $id): void
    {
        Auth::user()->notifications()->where('id', $id)->delete();

        $this->dispatch('notifications-updated', count($this->notifications));
    }

    #[On('notifications-updated')]
    public function update_notifications(): void
    {
        if ($this->notifications instanceof Collection) {
            $this->load_notifications(true);
        }
    }

    #[On('modal-show')]
    public function load_notifications(bool $force = false): void
    {
        if (!$this->notifications || $force) {
            $this->notifications = Auth
                ::user()
                ->notifications()
                ->where('type', Toast::class)
                ->get()
                ->sortBy('created_at');
        }
    }
}
?>

<flux:modal
    name="notifications"
    class="min-w-[25rem] p-4!"
    flyout
    position="left"
    variant="floating"
>
    <div class="space-y-3">
        <div>
            <flux:heading class="py-1" size="lg">{{ ___('dictionary.notifications') }}</flux:heading>
        </div>

        @if($notifications)
            @foreach($notifications as $notification)
                {{-- Bypass Jellybean's callout as we don't want the icon --}}
                <flux:callout class="p-2" :variant="$notification->data['variant']">
                    <x-slot name="controls">
                        <flux:button
                            icon="trash"
                            size="xs"
                            variant="ghost"
                            wire:click="delete('{{ $notification->id }}')"
                        />
                    </x-slot>

                    @if ($notification->data['heading'])
                        <flux:heading>
                            {{ ___($notification->data['heading'], $notification->data['translation_replacements']) }}
                        </flux:heading>
                    @endif

                    <flux:callout.text>
                        {{ ___($notification->data['text'], $notification->data['translation_replacements']) }}
                    </flux:callout.text>

                    <flux:text>
                        {{ $notification->created_at->diffForHumans() }}
                    </flux:text>

                    @if ($notification->data['link'])
                        <flux:callout.link class="text-sm" :href="$notification->data['link']">
                            {{ ___('dictionary.view') }}
                        </flux:callout.link>
                    @endif
                </flux:callout>
            @endforeach
        @else
            <x-callout variant="secondary">{{ ___('phrases.loading', 'dictionary.notifications') }}</x-callout>
        @endif
    </div>
</flux:modal>
