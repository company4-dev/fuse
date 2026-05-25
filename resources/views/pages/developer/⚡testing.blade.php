<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;

new class extends Component
{
    public $debug = null;

    public function mount()
    {
        $this->layout(
            [
                'developer.developer-testing',
            ],
            Icons::testing()
        );

        // ------------------------------
        // Do your testing below this line
        // ------------------------------
        $this->debug = __LINE__;
    }
};
?>

<div>
    @dump($debug)
</div>
