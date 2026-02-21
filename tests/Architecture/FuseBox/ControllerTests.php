<?php

arch()
    ->expect('App\Http\Controllers')
    ->toBeClasses()
    ->classes()
    ->toHaveSuffix('Controller');
