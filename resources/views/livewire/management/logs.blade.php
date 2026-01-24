<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;

use function Livewire\Volt\mount;

mount(function () {
    Livewire::layout(
        [
            'dictionary.management',
            'dictionary.logs',
        ],
        Icons::log(),
    );
});

?>

<x-logs />
