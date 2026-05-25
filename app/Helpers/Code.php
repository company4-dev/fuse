<?php

declare(strict_types=1);

namespace App\Helpers;

class Code
{
    /**
     * @return mixed[]
     */
    public static function trace(int $limit = 1): array
    {
        $traces = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $limit + 1);
        $traces = array_slice($traces, 1);
        $key    = count($traces);

        foreach ($traces as &$t) {
            $trace[$key] = [
                'file'     => $t['file'] ?? 'Unknown',
                'line'     => $t['line'] ?? 'Unknown',
                'function' => $t['function'] ?? 'Unknown',
            ];

            if (array_key_exists('args', $t)) {
                $trace[$key]['args'] = $t['args'];
            }

            $key--;
        }

        return $traces;
    }
}
