<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\Helpers\Log;
use App\Helpers\Routes;

new class extends Component
{
    public $menu;

    public function mount($menu)
    {
        if ($menu ?? false) {
            foreach ($menu as $i => $attributes) {
                $attributes['route'] ??= false;

                if (!$attributes['route']
                    && !array_key_exists('confirm', $attributes)
                    && !array_key_exists('modal', $attributes)
                    && !array_key_exists('wire:click', $attributes)
                ) {
                    throw new Exception(___('errors.exceptions.layouts.menu.missing-route', ___($attributes['label'])));
                } elseif ($attributes['route'] ?? false) {
                    $this->menu[$i]['route'] = Routes::make($attributes['route']);
                }
            }
        }
    }

    public function wire_click($i)
    {
        if (array_key_exists('confirm', $this->menu[$i])) {
            Log::debug($this->menu[$i]);
            $confirm = $this->menu[$i]['confirm'];
            $confirm['cancel-text'] ??= 'dictionary.no';
            $cancel_text = is_array($confirm['cancel-text'])
                ? ___(...$confirm['cancel-text'])
                : ___($confirm['cancel-text']);
            $confirm['confirm-text'] ??= 'dictionary.yes';
            $confirm_text = is_array($confirm['confirm-text'])
                ? ___(...$confirm['confirm-text'])
                : ___($confirm['confirm-text']);
            $message = is_array($confirm['message']) ? ___(...$confirm['message']) : ___($confirm['message']);
            $title   = is_array($this->menu[$i]['label'])
                ? ___(...$this->menu[$i]['label'])
                : ___($this->menu[$i]['label']);

            $this->js("
                window.dispatchEvent(new CustomEvent('show-confirm-modal', {
                    detail: {
                        title:       '".addslashes($title)."',
                        message:     '".addslashes($message)."',
                        cancelText:  '".addslashes($cancel_text)."',
                        confirmText: '".addslashes($confirm_text)."',
                        callback:    '".$this->menu[$i]['confirm']['callback']."'
                    }
                }));
            ");
        } elseif (array_key_exists('wire:click', $this->menu[$i])) {
            $this->dispatch($this->menu[$i]['wire:click']);
        } elseif (array_key_exists('modal', $this->menu[$i])) {
            $this->js('$flux.modal(\''.$this->menu[$i]['modal'].'\').show();');
        }
    }
};
?>

<flux:button.group class="ml-auto">
    @foreach ($menu as $i => $attributes)
        @if ($attributes['route'] ?? false)
            <flux:button
                :href="$attributes['route']"
                :icon="$attributes['icon']"
                :tooltip="___($attributes['label'])"
                tooltip:position="left"
                :variant="$attributes['variant'] ?? 'filled'"
            />
        @else
            <flux:button
                :icon="$attributes['icon']"
                :tooltip="___($attributes['label'])"
                tooltip:position="left"
                :variant="$attributes['variant'] ?? 'filled'"
                wire:click.stop="wire_click({{ $i }})"
            />
        @endif
    @endforeach
</flux:button.group>
