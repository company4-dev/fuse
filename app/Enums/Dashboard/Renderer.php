<?php

declare(strict_types=1);

namespace App\Enums\Dashboard;

use App\Base\Enum;

enum Renderer
{
    use Enum;

    case Blade;

    public function render($file): string
    {
        return match ($this) {
            self::Blade => view($file)->render(),
            default     => '',
        };
    }
}
