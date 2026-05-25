<?php

declare(strict_types=1);

namespace App\View\Forms;

use App\Base\LivewireForm;
use App\Hooks\Search as HooksSearch;

class Search extends LivewireForm
{
    public ?string $search = null;

    public function actions(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [
            [
                'autofocus'   => true,
                'callback'    => 'results',
                'label'       => 'dictionary.search',
                'name'        => 'search',
                'required'    => true,
                'type'        => 'autocomplete',
                'wrap-class'  => 'w-100',
                'x-on-change' => 'Livewire.navigate($event.target.value)',
            ],
        ];
    }

    public function results(): array
    {
        return HooksSearch::get($this->search);
    }

    protected function setModel($model, object $component): void {}
}
