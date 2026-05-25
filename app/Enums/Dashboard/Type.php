<?php

declare(strict_types=1);

namespace App\Enums\Dashboard;

use App\Base\Enum;

enum Type
{
    use Enum;

    case Chart;
    case Snack;
}
