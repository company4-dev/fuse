<?php

namespace App\Enums\Components\Callout;

use App\Traits\BaseEnum;

enum Variant
{
    use BaseEnum;

    case Danger;
    case Secondary;
    case Success;
    case Warning;

    public function icon(): string
    {
        return match ($this) {
            self::Danger    => 'circle-xmark',
            self::Secondary => 'circle-info',
            self::Success   => 'circle-check',
            self::Warning   => 'circle-exclamation',
        };
    }
}
