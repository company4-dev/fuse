<?php

$files = glob(__DIR__.'/functions/*.php');

foreach ($files as $file) {
    require_once $file;
}
