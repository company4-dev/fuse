<?php

use Illuminate\Support\Facades\App;

// Trim backtrace
function trace($limit = 1)
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

// Checks whether is a development environment
function is_dev()
{
    return (
        isset($_SERVER['REMOTE_ADDR']) &&
        (
            $_SERVER['REMOTE_ADDR'] == '::1' ||
            $_SERVER['REMOTE_ADDR'] == '127.0.0.1' ||
            str_contains($_SERVER['REMOTE_ADDR'], 'localhost') ||
            str_contains($_SERVER['REMOTE_ADDR'], 'dev.')
        )
    ) ||
        App::environment('local');
}
