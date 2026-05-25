<?php

use App\Base\Export;
use App\Helpers\Testing;
use Pest\Arch\Exceptions\ArchExpectationFailedException;
use Pest\Arch\ValueObjects\Violation;

foreach (Testing::wildcard_to_array('App\Exports\*') as $class) {
    test(
        'expect \''.$class.'\' → to call parent::__construct()',
        function () use ($class): void {
            $reflection = new ReflectionClass($class);

            if ($reflection->hasMethod('__construct')) {
                $code        = null;
                $constructor = $reflection->getMethod('__construct');
                $end         = null;
                $file        = null;
                $filename    = $constructor->getFileName();
                $found       = false;
                $start       = $constructor->getStartLine();

                $end  = $constructor->getEndLine();
                $file = file($filename);

                $code = implode('', array_slice($file, $start - 1, $end - $start + 1));
                $code = array_map(trim(...), explode("\n", $code));

                foreach ($code as $line) {
                    if (str_starts_with($line, 'parent::__construct')) {
                        $found = true;

                        break;
                    }
                }

                if (!$found) {
                    throw new ArchExpectationFailedException(
                        new Violation($filename, $start + 2, $end),
                        'Call to parent::__construct() is missing from class constructor.'
                    );
                }
            }
        }
    )
    ->throwsNoExceptions();

    arch()
        ->expect($class)
        ->toBeClass()
        ->toExtend(Export::class);
}
