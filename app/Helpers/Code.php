<?php

namespace App\Helpers;

class Code
{
    public static function trace(int $limit = 1)
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
