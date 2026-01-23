<?php

namespace Fuse\Helpers;

use Exception;
use Illuminate\Support\Facades\Log as FacadeLog;

class Log
{
    public static function snippet(string $file, int $line_number, bool $inline = false)
    {
        if (!is_file($file)) {
            return null;
        }

        if (str_contains($line_number, ':')) {
            $line_number = explode(':', $line_number)[0];
        }

        $html   = '';
        $length = 10;
        $start  = $line_number - $length;
        $temp   = tmpfile();

        fwrite($temp, "<?php\n");

        $lines = file($file);

        for ($current_line = $start; $current_line < $line_number + $length + 1; $current_line++) {
            if (array_key_exists($current_line, $lines)) {
                fwrite($temp, $lines[$current_line]);
            }
        }

        $file = strip_tags(highlight_file(stream_get_meta_data($temp)['uri'], true), '<span>');

        fclose($temp);

        foreach (explode("\n", $file) as $i => $line) {
            if ($i === 0) {
                continue;
            }

            $is_target = $i + $start === $line_number;

            $html .= match ($inline) {
                true  => ($is_target ? '! ' : '  ').($i + $start).': '.html_entity_decode(strip_tags($line))."\n",
                false => '<div class="d-flex gap-1">
                    <span class="fw-bold min-w-5 text-primary">'.($i + $start).'</span>
                    <code class="w-100"><pre class="mb-0'.($is_target ? ' bg-primary-25' : '').'">'.$line.'</pre></code>
                </div>',
            };
        }

        return $html;
    }

    public static function __callStatic($name, $arguments)
    {
        $hide_arguments = false;
        $levels         = [
            'emergency' => '31',
            'alert'     => '95',
            'critical'  => '35',
            'error'     => '33',
            'warning'   => '93',
            'notice'    => '36',
            'info'      => '96',
            'debug'     => '90',
        ];

        if (in_array($name, array_keys($levels))) {
            $color     = $levels[$name];
            $exception = new Exception;
            $name      = ucwords($name);
            $trace     = $exception->getTrace()[0];

            if (!isset($arguments[1])) {
                if (isset($arguments[0])) {
                    $arguments = $arguments[0];
                } else {
                    $hide_arguments = true;
                }
            }

            $clean_output = str_replace(base_path(), '', $trace['file']).':'.$trace['line'];
            $output       = "\e[90m".$clean_output."\e[0m";

            if (!$hide_arguments) {
                $output .= "\e[".$color."m\r\n".(is_array($arguments) ? '' : "\t").var_export($arguments, true);
            }

            $output .= "\e[0m";

            FacadeLog::channel('daily')->$name($output);
        }
    }
}
