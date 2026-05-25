<?php

declare(strict_types=1);

$files = glob(__DIR__.'/functions/*.php');

foreach ($files as $file) {
    require_once $file;
}
