<?php

use App\Traits\BaseInputComponent;
use App\View\Components\Form;

arch()
    ->expect(Form::class)
    ->toBeClasses()
    ->toUseTrait(BaseInputComponent::class);
