<?php

namespace App\Helpers;

use Carbon\Carbon;

class Dates
{
    const MINUTE_IN_SECONDS = 60;
    const HOUR_IN_SECONDS   = 60 * 60;
    const DAY_IN_SECONDS    = 60 * 60 * 24;
    const WEEK_IN_SECONDS   = 60 * 60 * 24 * 7;
    const MONTH_IN_SECONDS  = 60 * 60 * 24 * 365.25 / 12;
    const YEAR_IN_SECONDS   = 60 * 60 * 24 * 365.25;

    public static function date($time = false)
    {
        if ($time === null) {
            return ___('acronyms.na');
        }

        if ($time === false) {
            $time = time();
        }

        if (!is_numeric($time)) {
            $time = strtotime($time);
        }

        return date(config('settings.formats.date'), $time);
    }

    public static function datetime($time = false)
    {
        if ($time === null) {
            return ___('acronyms.na');
        }

        if ($time === false) {
            $time = time();
        }

        if (!is_numeric($time)) {
            $time = strtotime($time);
        }

        $format = match ((int) config('settings.formats.datetime')) {
            1 => config('settings.formats.date').' '.config('settings.formats.time'),
            2 => 'c',
            3 => 'r',
        };

        return date($format, $time);
    }

    public static function date_formats()
    {
        return [
            'd/m/\'y' => 'DD/MM/\'YY ('.date('d/m/\'y').')',
            'd/m/Y'   => 'DD/MM/YYYY ('.date('d/m/Y').')',
            'd M \'y' => 'DD/MM/\'YY ('.date('d M \'y').')',
            'd M Y'   => 'DD Mon YYYY ('.date('d M Y').')',
            'd F \'y' => 'DD Month \'YY ('.date('d F \'y').')',
            'd F Y'   => 'DD Month YYYY ('.date('d F Y').')',
        ];
    }

    public static function date_ranges()
    {
        return [
            1  => ___('dictionary.today'),
            2  => ___('dictionary.yesterday'),
            3  => ___('phrases.this-week'),
            4  => ___('phrases.past-week'),
            5  => ___('phrases.last-week'),
            6  => ___('phrases.this-month'),
            7  => ___('phrases.past-month'),
            8  => ___('phrases.last-month'),
            9  => ___('phrases.this-year'),
            10 => ___('phrases.past-year'),
            11 => ___('phrases.last-year'),
            12 => ___('dictionary.custom'),
        ];
    }

    public static function dates_from_range($start_date, $end_date = null, $start_inclusive = true, $end_inclusive = true)
    {
        $dates      = [];
        $length     = null;
        $start_date = now()->parse($start_date)->startOfDay();

        $end_date = $end_date ? now()->parse($end_date) : now();

        $end_date = $end_date->startOfDay();

        if (!$end_inclusive) {
            $end_date->subDay();
        }

        if (!$start_inclusive) {
            $start_date->addDay();
        }

        $length = $start_date->diffInDays($end_date, false) + 1;

        for ($i = 0; $i < $length; $i++) {
            $dates[] = self::process_date($start_date->clone()->addDays($i));
        }

        return $dates;
    }

    public static function datetime_formats()
    {
        return [
            1 => '['.___('phrases.date-format').'] ['.___('phrases.time-format').'] ('.date(config('settings.formats.date').' '
                .config('settings.formats.time')).')',
            2 => 'ISO 8601 ('.date('c').')',
            3 => 'RFC 2822 ('.date('r').')',
        ];
    }

    public static function getTimeUntilDate($date)
    {
        return date_diff(date_create($date), now());
    }

    public static function isPastDate($date)
    {
        return now()->diffInSeconds($date) < 0;
    }

    public static function process_date(Carbon $carbon, array $data = [])
    {
        return array_merge(
            [
                'before_today'    => $carbon->isBefore(now()->startOfDay()),
                'is_today'        => $carbon->isToday(),
                'formatted'       => self::date($carbon->timestamp),
                'raw'             => $carbon->format('Y-m-d'),
                'short'           => $carbon->format('m-d'),
                'short_formatted' => self::yearless_date($carbon->timestamp),
            ],
            $data
        );
    }

    public static function time_formats()
    {
        return [
            'h:i'   => ___('phrases-12-hour').' ('.date('h:i a').')',
            'h:i:s' => ___('phrases-12-hour-with-seconds').' ('.date('h:i:s a').')',
            'H:i'   => ___('phrases-24-hour').' ('.date('H:i').')',
            'H:i:s' => ___('phrases-24-hour-with-seconds').' ('.date('H:i:s').')',
        ];
    }

    public static function time($time = false, $format = null)
    {
        if ($time === null) {
            return ___('acronyms.na');
        }

        if ($time === false) {
            $time = time();
        }

        if (!is_numeric($time)) {
            $time = strtotime($time);
        }

        if ($format === null) {
            $format = config('settings.formats.time');
        }

        return date($format, $time);
    }

    public static function time_as_hours($hours = 0, $minutes = 0)
    {
        $hours += $minutes / 60;
        $minutes = $hours - floor($hours);
        $hours -= $minutes;

        return number_format($hours).':'.str_pad(round($minutes * 60, 2), 2, '0', STR_PAD_LEFT);
    }

    // Time ago
    public static function time_ago(string $date, $full = false)
    {
        return ucwords(now()
            ->parse($date)
            ->diffForHumans([
                'options' => Carbon::JUST_NOW,
                'short'   => !$full,
            ]));
    }

    public static function yearless_date($time = false)
    {
        if ($time === null) {
            return ___('acronyms.na');
        }

        if ($time === false) {
            $time = time();
        }

        if (!is_numeric($time)) {
            $time = strtotime($time);
        }

        return date(
            implode('/', array_filter(explode('/', trim(str_replace(['Y', 'y', '\''], '', config('settings.formats.date')))))),
            $time
        );
    }
}
