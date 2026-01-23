<?php

namespace Fuse\View\Components\Layouts;

use Illuminate\View\Component;
use Illuminate\View\View;

class App extends Component
{
    public $breadcrumbs;
    public $icon;
    public $title;

    public function __construct(
        public array $layout,
    ) {
        foreach ($layout as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function render(): View
    {
        return view('components.layouts.app');
    }
}
