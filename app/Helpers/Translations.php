<?php

namespace App\Helpers;

class Translations
{
    public static function daysOfWeek(?int $day = null)
    {
        $days = [
            1 => 'dates.dow.1',
            2 => 'dates.dow.2',
            3 => 'dates.dow.3',
            4 => 'dates.dow.4',
            5 => 'dates.dow.5',
            6 => 'dates.dow.6',
            7 => 'dates.dow.7',
        ];

        return $day ? ___($days[$day]) : $days;
    }

    public static function months(?int $month = null)
    {
        $months = [
            1  => 'dates.months.1',
            2  => 'dates.months.2',
            3  => 'dates.months.3',
            4  => 'dates.months.4',
            5  => 'dates.months.5',
            6  => 'dates.months.6',
            7  => 'dates.months.7',
            8  => 'dates.months.8',
            9  => 'dates.months.9',
            10 => 'dates.months.10',
            11 => 'dates.months.11',
            12 => 'dates.months.12',
        ];

        return $month ? ___($months[$month]) : $months;
    }

    public static function statuses(?int $status = null)
    {
        $statuses = [
            1 => 'dictionary.enabled',
            0 => 'dictionary.disabled',
        ];

        return $status !== null ? ___($statuses[$status]) : $statuses;
    }

    public static function yes_no(?int $status = null)
    {
        $statuses = [
            1 => 'dictionary.yes',
            0 => 'dictionary.no',
        ];

        return $status !== null ? ___($statuses[$status]) : $statuses;
    }
}
