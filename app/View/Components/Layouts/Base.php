<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use Illuminate\View\View;

class Base extends Component
{
    public function __construct(
        public ?string $class = null,
    ) {
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // dd($this);
        return view('components.layouts.base');
    }
}
