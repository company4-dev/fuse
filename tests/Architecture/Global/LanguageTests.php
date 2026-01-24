<?php

arch('should use triple underscore translation helper instead of double')
    ->expect('*')
    ->toOnlyUse([
        '___', // Allow triple underscore
    ])
    ->ignoring([
        '__construct', // Ignore constructors
        '__invoke',    // Ignore magic methods
        '__call',
        '__get',
        '__set',
    ]);
