<?php

use App\Helpers\Testing;
use App\Traits\InputComponent;

foreach (Testing::wildcard_to_array('App\View\Components\Forms\*') as $class) {
    arch()
        ->expect($class)
        ->toBeClasses()
        ->toUseTrait(InputComponent::class);
}
