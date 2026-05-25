<?php

declare(strict_types=1);

namespace App\Enums;

use App\Base\Enum;

enum UserStatus: int
{
    use Enum;

    case ACTIVE   = 1;
    case INACTIVE = 0;

    public function details(?string $attribute = null): array|string
    {
        $attributes = match ($this) {
            self::ACTIVE => [
                'color' => 'green',
                'label' => ___('dictionary.active'),
            ],
            self::INACTIVE => [
                'color' => 'red',
                'label' => ___('dictionary.inactive'),
            ],
        };

        if ($attribute) {
            return $attributes[$attribute];
        }

        return $attributes;
    }

    public function detail(?string $detail): string
    {
        return $this->details($detail);
    }
}
