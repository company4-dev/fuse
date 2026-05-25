<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;

new class extends Component
{
    public function mount()
    {
        $this->layout(
            [
                'management' => 'dictionary.management',
                'dictionary.logs',
            ],
            Icons::log(),
        );
    }
};
?>

<x-logs />
