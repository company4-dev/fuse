<?php

namespace Fuse\View\Components;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Tab extends Component
{
    public $slug;

    public function __construct(string $target)
    {
        $this->slug = Str::slug(___($target));

        if (!in_array($this->slug, view()->shared('allowed_tabs'))) {
            throw new Exception(___('errors.exceptions.components.tab.invalid-tab'));
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tab');
    }
}
