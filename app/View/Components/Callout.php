<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Enums\Components\Callout\Variant as CalloutVariant;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Callout extends Component
{
    public string $icon;

    public function __construct(
        public string $variant = 'secondary',
    ) {
        $this->icon = CalloutVariant::fromName($variant)->icon();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.callout');
    }
}
