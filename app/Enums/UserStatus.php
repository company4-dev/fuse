<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum UserStatus: int
{
    use BaseEnum;

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

    public function detail($detail): string
    {
        return $this->details($detail);
    }
}
