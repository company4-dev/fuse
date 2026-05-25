<?php

declare(strict_types=1);

namespace App\View\Forms;

use App\Base\LivewireForm;
use Illuminate\Support\Collection;

class Developer extends LivewireForm
{
    public ?string $action = null;

    public function actions(): array
    {
        return [
            [
                'component' => 'field',
                'label'     => 'developer.create',
                'name'      => 'save',
                'type'      => 'submit',
            ],
        ];
    }

    public function fields(): array
    {
        return [
            [
                'label'    => 'dictionary.action',
                'modifier' => 'change',
                'name'     => 'action',
                'options'  => [
                    'make-filter' => ___('developer.make-filter'),
                ],
                'type' => 'options',
            ],
        ];
    }

    public function submit(Collection $validated): string
    {
        return 'dashboard';
    }

    protected function setModel($model, object $component): void {}
}
