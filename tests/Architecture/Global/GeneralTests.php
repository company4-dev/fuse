<?php

arch()
    ->expect('*')
    ->toHaveLineCountLessThan(1_000);
