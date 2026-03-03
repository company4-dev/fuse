<?php

namespace App\Helpers;

use Illuminate\Support\Number;

class Schedule
{
    public static function fields(array $field): array
    {
        $days_of_month = [];
        $days_of_week  = Translations::daysOfWeek();
        // $days_of_week[8] = 'dictionary.day';  // Not sure why this was in the original code. Keeping for compatibility reasons
        $days_of_week[9]  = 'dictionary.weekday';
        $days_of_week[10] = 'phrases.weekend-day';
        $months           = Translations::months();
        $nths             = [];

        foreach (range(1, 4) as $nth) {
            $nths[$nth] = 'dictionary.'.Number::spellOrdinal($nth);
        }
        $nths[5] = 'dictionary.last';

        foreach (range(1, 31) as $day) {
            $days_of_month[$day] = Number::ordinal($day);
        }

        $fields = [
            // Start Date
            'start-date' => [
                'label'    => ['phrases.date', ['dictionary.start']],
                'name'     => $field['name'].'[start_date]',
                'required' => $field['required'] ?? false,
                'type'     => 'date',
            ],

            // End Type
            'end-type' => [
                'label'   => 'phrases.end-type',
                'name'    => $field['name'].'[end_type]',
                'options' => [
                    1 => 'phrases.end-by',
                    2 => ['phrases.end-after-x-occurrences', ['X']],
                    3 => 'phrases.no-end-date',
                ],
                'required' => $field['required'] ?? false,
                'type'     => 'radio',
            ],

            // End Date (End Type == 1)
            'end-date' => [
                'label' => ['phrases.date', ['dictionary.end']],
                'name'  => $field['name'].'[end_date]',
                'rules' => [
                    'after_or_equal:'.$field['name'].'.start_date',
                    'required_if:'.$field['name'].'.end_type,1',
                ],
                'type' => 'date',
            ],

            // End After (End Type == 2)
            'end-after' => [
                'label'  => ['phrases.end-after-x-occurrences', ['X']],
                'max'    => 99,
                'min'    => 1,
                'name'   => $field['name'].'[end_after]',
                'prefix' => 'X =',
                'rules'  => [
                    'required_if:'.$field['name'].'.end_type,2',
                ],
                'suffix' => 'dictionary.times',
                'type'   => 'number',
            ],
        ];

        if ($field['time'] ?? true) {
            $fields = array_merge(
                $fields,
                [
                    'start-time' => [
                        'label'    => ['phrases.time', ['dictionary.start']],
                        'name'     => $field['name'].'[start_time]',
                        'required' => $field['required'] ?? false,
                        'rules'    => [
                            'before:'.$field['name'].'.end_time',
                        ],
                        'type' => 'time',
                    ],
                    'end-time' => [
                        'label'    => ['phrases.time', ['dictionary.end']],
                        'name'     => $field['name'].'[end_time]',
                        'required' => $field['required'] ?? false,
                        'type'     => 'time',
                    ],
                ]
            );
        }

        $fields = array_merge(
            $fields,
            [
                'schedule' => [
                    'label'   => 'dictionary.recurrence',
                    'name'    => $field['name'].'[schedule]',
                    'options' => [
                        1 => 'dictionary.daily',
                        2 => 'dictionary.weekly',
                        3 => 'dictionary.monthly',
                        4 => 'dictionary.yearly',
                    ],
                    'required' => $field['required'] ?? false,
                    'type'     => 'radio',
                ],

                // Daily
                'daily-type' => [
                    'label'   => 'phrases.recurrence-type',
                    'name'    => $field['name'].'[recurrence][1][recurrence_type]',
                    'options' => [
                        1 => ['phrases.every-x-y', ['X', 'dictionary.days']],
                        2 => ['phrases.every-x', ['dictionary.weekday']],
                    ],
                    'rules' => [
                        'required_if:'.$field['name'].'.schedule,1',
                    ],
                    'type' => 'radio',
                ],
                'daily-interval' => [
                    'label'  => ['phrases.every-x-y', ['X', 'dictionary.days']],
                    'max'    => 999,
                    'min'    => 1,
                    'name'   => $field['name'].'[recurrence][1][every]',
                    'prefix' => 'X =',
                    'rules'  => [
                        'required_if:'.$field['name'].'.recurrence.1.recurrence_type,1',
                    ],
                    'suffix' => 'dictionary.days',
                    'type'   => 'number',
                ],

                // Weekly
                'weekly-interval' => [
                    'label'  => ['phrases.every-x-y', ['X', 'dictionary.weeks']],
                    'max'    => 99,
                    'min'    => 1,
                    'name'   => $field['name'].'[recurrence][2][every]',
                    'prefix' => 'X =',
                    'rules'  => [
                        'required_if:'.$field['name'].'.schedule,2',
                    ],
                    'suffix' => 'dictionary.weeks',
                    'type'   => 'number',
                ],
                'weekly-on' => [
                    'label'   => 'dictionary.on',
                    'name'    => $field['name'].'[recurrence][2][day]',
                    'options' => $days_of_week,
                    'rules'   => [
                        'required_if:'.$field['name'].'.schedule,2',
                    ],
                    'suffix' => 'dictionary.weeks',
                    'type'   => 'radio',
                ],

                // Monthly
                'monthly-every' => [
                    'label'  => ['phrases.every-x-y', ['X', 'dictionary.months']],
                    'max'    => 99,
                    'min'    => 1,
                    'name'   => $field['name'].'[recurrence][3][every]',
                    'prefix' => 'X =',
                    'rules'  => [
                        'required_if:'.$field['name'].'.schedule,3',
                    ],
                    'suffix' => 'dictionary.weeks',
                    'type'   => 'number',
                ],
                'monthly-type' => [
                    'label'   => 'phrases.recurrence-type',
                    'name'    => $field['name'].'[recurrence][3][recurrence_type]',
                    'options' => [
                        1 => 'phrases.specific-day',
                        2 => 'phrases.nth-day',
                    ],
                    'rules' => [
                        'required_if:'.$field['name'].'.schedule,3',
                    ],
                    'type' => 'radio',
                ],
                'monthly-day' => [
                    'label'   => 'phrases.day-of-month',
                    'name'    => $field['name'].'[recurrence][3][day]',
                    'options' => $days_of_month,
                    'rules'   => [
                        'required_if:'.$field['name'].'.recurrence.3.recurrence_type,1',
                    ],
                    'type' => 'options',
                ],
                'monthly-week' => [
                    'label'   => 'dictionary.week',
                    'name'    => $field['name'].'[recurrence][3][week]',
                    'options' => $nths,
                    'rules'   => [
                        'required_if:'.$field['name'].'.recurrence.3.recurrence_type,2',
                    ],
                    'type' => 'radio',
                ],
                'monthly-dow' => [
                    'label'   => 'phrases.day-of-week',
                    'name'    => $field['name'].'[recurrence][3][dow]',
                    'options' => $days_of_week,
                    'rules'   => [
                        'required_if:'.$field['name'].'.recurrence.3.recurrence_type,2',
                    ],
                    'type' => 'options',
                ],

                // Yearly
                'yearly-interval' => [
                    'label'  => ['phrases.every-x-y', ['X', 'dictionary.years']],
                    'max'    => 99,
                    'min'    => 1,
                    'name'   => $field['name'].'[recurrence][4][every]',
                    'prefix' => 'X =',
                    'rules'  => [
                        'required_if:'.$field['name'].'.schedule,4',
                    ],
                    'suffix' => 'dictionary.years',
                    'type'   => 'number',
                ],
                'yearly-type' => [
                    'label'   => 'phrases.recurrence-type',
                    'name'    => $field['name'].'[recurrence][4][recurrence_type]',
                    'options' => [
                        1 => 'phrases.specific-day',
                        2 => 'phrases.nth-day',
                    ],
                    'rules' => [
                        'required_if:'.$field['name'].'.schedule,4',
                    ],
                    'type' => 'radio',
                ],
                'yearly-day' => [
                    'label'   => 'phrases.day-of-month',
                    'name'    => $field['name'].'[recurrence][4][day]',
                    'options' => $days_of_month,
                    'rules'   => [
                        'required_if:'.$field['name'].'.recurrence.4.recurrence_type,1',
                    ],
                    'type' => 'options',
                ],
                'yearly-week' => [
                    'label'   => 'dictionary.week',
                    'name'    => $field['name'].'[recurrence][4][week]',
                    'options' => $nths,
                    'rules'   => [
                        'required_if:'.$field['name'].'.recurrence.4.recurrence_type,2',
                    ],
                    'type' => 'radio',
                ],
                'yearly-dow' => [
                    'label'   => 'phrases.day-of-week',
                    'name'    => $field['name'].'[recurrence][4][dow]',
                    'options' => $days_of_week,
                    'rules'   => [
                        'required_if:'.$field['name'].'.recurrence.4.recurrence_type,2',
                    ],
                    'type' => 'options',
                ],
                'yearly-month' => [
                    'label'   => 'dictionary.month',
                    'name'    => $field['name'].'[recurrence][4][month]',
                    'options' => $months,
                    'rules'   => [
                        'required_if:'.$field['name'].'.recurrence.4.recurrence_type,112',
                    ],
                    'type' => 'options',
                ],
            ]
        );

        return array_map(
            function ($field) {
                $field['name'] = 'form.'.preg_replace('/\[([^\]]+)\]/', '.$1', $field['name']);

                return $field;
            },
            $fields
        );
    }
}
