<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    public string $label;
    public ?string $href;

    public function __construct(?string $label, ?string $href = null, ?array $action = null, ?array $field = [])
    {
        $this->label = ___($label ?? $field['label'] ?? $action['label']);
        $this->href  = $href ?? $field['href'] ?? $action['href'] ?? null;

        if ($this->href && !str_starts_with($this->href, 'http')) {
            $this->href = route($this->href);
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.link');
    }
}
