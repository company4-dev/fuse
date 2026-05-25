<?php

declare(strict_types=1);

namespace App\Enums\Components\Form;

use App\Base\Enum;

enum Mime
{
    use Enum;

    case Images;

    public function extensions(): array
    {
        return match ($this) {
            self::Images => ['jpeg', 'jpg', 'png'],
        };
    }

    public function mimes(): array
    {
        return match ($this) {
            self::Images => ['image/jpeg', 'image/png'],
        };
    }
}
