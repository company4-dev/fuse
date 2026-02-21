<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Tabs extends Component
{
    public $tabs;

    public function __construct(array $tabs)
    {
        foreach ($tabs as $tab) {
            $tab['label'] = ___($tab['label']);

            $this->tabs[Str::slug($tab['label'])] = $tab;
        }

        view()->share('allowed_tabs', array_keys($this->tabs));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tabs');
    }
}
