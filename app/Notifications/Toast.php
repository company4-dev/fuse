<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class Toast extends Notification
{
    use Queueable;

    private array $args = [];

    public function __construct(
        string $text,
        ?string $heading = null,
        ?string $variant = null,
        array $translation_replacements = [],
        ?string $link = null
    ) {
        $this->args = [
            'heading'                  => $heading,
            'link'                     => $link,
            'text'                     => $text,
            'translation_replacements' => $translation_replacements,
            'variant'                  => $variant,
        ];
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return $this->args;
    }
}
