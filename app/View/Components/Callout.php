<?php

namespace Fuse\View\Components;

use Closure;
use Fuse\Enums\Components\Callout\Variant as CalloutVariant;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Callout extends Component
{
    public $icon;

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
