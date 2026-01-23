<?php

namespace Fuse\Models;

use Fuse\Jobs\GenerateScheduleDates;
use Fuse\Observers\ScheduleObserver;
use Fuse\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kodeine\Metable\Metable;

#[ObservedBy(ScheduleObserver::class)]
class Schedule extends Model
{
    use BaseModel;
    use Metable;

    protected $fillable  = [];
    protected $metaTable = 'schedule_meta';
    protected $table     = 'schedules';

    // Attributes
    public function datesAfterToday(): Attribute
    {
        return new Attribute(fn () => $this->dates()->whereDate('date', '>', now())->count());
    }

    public function isEndless(): Attribute
    {
        return new Attribute(fn () => $this->end_date === null && $this->end_after === null);
    }

    public function lastDate(): Attribute
    {
        return new Attribute(function () {
            if ($this->is_endless) {
                return false;
            }

            return $this->dates()->orderBy('id', 'desc')->first()->date ?? false;
        });
    }

    public function nextDate(): Attribute
    {
        return new Attribute(fn () => $this->dates()->WhereDate('date', '>', now())->first()->date ?? false);
    }

    protected function route(): Attribute
    {
        return new Attribute(fn () => null);
    }

    // Methods
    /**
     * Returns the next scheduled item.
     *
     * @param int $start
     */
    public function generate_next_date($start): false|string
    {
        if (!is_numeric($start)) {
            $start = strtotime($start);
        }
        $carbon_start = today()->setTimestamp($start)->add(1, 'hour');
        // Return false if has end date and date has passed
        if ($this->end_date && strtotime($this->end_date) < $start) {
            return false;
        }
        $hour        = 60 * 60;
        $day         = $hour * 24;
        $day_of_week = $carbon_start->format('N');
        $dow         = null;
        $next_time   = $start;
        $week        = null;
        switch ($this->week) {
            case 1:
                $week = 'first';
                break;
            case 2:
                $week = 'second';
                break;
            case 3:
                $week = 'third';
                break;
            case 4:
                $week = 'forth';
                break;
            case 5:
                $week = 'last';
                break;
        }
        switch ($this->dow) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
                $dow = now()->parse('Sunday +'.$this->dow.' days')->format('l');
                break;
            case 8:
                $dow = 'day';
                break;
            case 9:
                $dow = 'weekday';
                break;
        }
        if ($this->schedule === 1) {
            // Daily
            if ($this->recurrence_type === 1) {
                // Every X Days
                for ($i = 0; $i < $this->every; $i++) {
                    $before = (int) date('I', $next_time);
                    $next_time += $day;
                    $after = (int) date('I', $next_time);
                    if ($before !== $after) {
                        if ($before) {
                            $next_time += $hour;
                        } elseif ($after) {
                            $next_time -= $hour;
                        }
                    }
                }
            } elseif ($this->recurrence_type === 2) {
                // Every weekday
                $before = (int) date('I', $next_time);
                $next_time += $day;
                $after = (int) date('I', $next_time);
                if ($before !== $after) {
                    if ($before) {
                        $next_time += $hour;
                    } elseif ($after) {
                        $next_time -= $hour;
                    }
                }
                if ($day_of_week == '6') {
                    for ($i = 0; $i < 2; $i++) {
                        $before = (int) date('I', $next_time);
                        $next_time += $day;
                        $after = (int) date('I', $next_time);
                        if ($before !== $after) {
                            if ($before) {
                                $next_time += $hour;
                            } elseif ($after) {
                                $next_time -= $hour;
                            }
                        }
                    }
                } elseif ($day_of_week == '7') {
                    $before = (int) date('I', $next_time);
                    $next_time += $day;
                    $after = (int) date('I', $next_time);
                    if ($before !== $after) {
                        if ($before) {
                            $next_time += $hour;
                        } elseif ($after) {
                            $next_time -= $hour;
                        }
                    }
                }
            }
        } elseif ($this->schedule === 2) {
            // Weekly
            $days = explode(',', $this->every_on);
            // Add another week to make sure we can loop round to the first of next week if needed
            foreach ($days as $day) {
                $days[] = (int) $day + 7;
            }
            foreach ($days as $day) {
                if ($day > $day_of_week) {
                    $next_time += ($day - $day_of_week) * $day;
                    break;
                }
            }
        } elseif ($this->schedule === 3) {
            // Monthly
            $day   = $this->day;
            $month = $carbon_start->format('m');
            $year  = $carbon_start->format('Y');
            if ($this->recurrence_type === 1) {
                if ($year.'-'.$month.'-'.$day === $carbon_start->format('Y-m-d')) {
                    $month++;
                }
                if ($this->day <= now()->format('j')) {
                    $month++;
                }
                if ($month === 13) {
                    $month = 1;
                    $year++;
                }
                $days_in_month = now()->parse($year.'-'.$month.'-01')->format('t');
                if ($days_in_month < $day) {
                    $day = $days_in_month;
                }
                $next_time = now()->parse($year.'-'.$month.'-'.$day)->timestamp;
            } elseif ($this->recurrence_type === 2) {
                if ($this->dow < 10) {
                    $next_month = $carbon_start->modify($week.' '.$dow.' +'.$this->every.' months')->timestamp;
                    $this_month = $carbon_start->modify($week.' '.$dow.' of this month')->timestamp;
                } else {
                    $next_saturday = $carbon_start->modify($week.' saturday +'.$this->every.' months')->timestamp;
                    $next_sunday   = $carbon_start->modify($week.' sunday +'.$this->every.' months')->timestamp;
                    $this_saturday = $carbon_start->modify($week.' saturday of this month')->timestamp;
                    $this_sunday   = $carbon_start->modify($week.' sunday of this month')->timestamp;
                    if ($this->week <= 4) {
                        $next_month = min($next_saturday, $next_sunday);
                        $this_month = min($this_saturday, $this_sunday);
                    } else {
                        $next_month = max($next_saturday, $next_sunday);
                        $this_month = max($this_saturday, $this_sunday);
                    }
                }
                $next_time = $start >= $this_month ? $next_month : $this_month;
            }
        } elseif ($this->schedule === 4) {
            // Yearly
            if ($this->recurrence_type === 1) {
                // Specific date (Month & Day)
                $next_year = now()->parse(($carbon_start->format('Y') + $this->every).'-'.$this->month.'-'.$this->day)->timestamp;
                $this_year = now()->parse($carbon_start->format('Y').'-'.$this->month.'-'.$this->day)->timestamp;
                $next_time = $start >= $this_year ? $next_year : $this_year;
            } elseif ($this->recurrence_type === 2) {
                // On the nth Date of Every x years
                if ($this->dow < 10) {
                    $next_year = now()
                        ->parse($week.' '.$dow.' '.($carbon_start->format('Y') + $this->every).'-'.$this->month.'-01')
                        ->timestamp;
                    $this_year = now()
                        ->parse($week.' '.$dow.' '.$carbon_start->format('Y').'-'.$this->month.'-01')
                        ->timestamp;
                } else {
                    $next_saturday = now()
                        ->parse($week.' saturday'.$dow.' '.($carbon_start->format('Y') + $this->every).'-'.$this->month.'-01')
                        ->timestamp;
                    $next_sunday = now()
                        ->parse($week.' sunday'.$dow.' '.($carbon_start->format('Y') + $this->every).'-'.$this->month.'-01')
                        ->timestamp;
                    $this_saturday = now()
                        ->parse($week.' saturday'.$dow.' '.($carbon_start->format('Y')).'-'.$this->month.'-01')
                        ->timestamp;
                    $this_sunday = now()
                        ->parse($week.' sunday'.$dow.' '.($carbon_start->format('Y')).'-'.$this->month.'-01')
                        ->timestamp;
                    if ($this->week <= 4) {
                        $next_year = min($next_saturday, $next_sunday);
                        $this_year = min($this_saturday, $this_sunday);
                    } else {
                        $next_year = max($next_saturday, $next_sunday);
                        $this_year = max($this_saturday, $this_sunday);
                    }
                }
                $next_time = $start >= $this_year ? $next_year : $this_year;
            }
        }
        // Return false if has end date and date has passed
        if ($this->end_date && now()->parse($this->end_date)->timestamp < $next_time) {
            return false;
        }

        return $carbon_start->setTimestamp($next_time)->format('Y-m-d');
    }

    public function replace($inputs, $assignee, $generates = null)
    {
        $this->dates()->whereDate('date', '>', $inputs['start_date'])->delete();
        static::store($inputs, $assignee, $generates);
    }

    public function store($inputs, $assignee, $generates = null)
    {
        $inputs['end_datetime'] ??= $inputs['start_date'].' '.$inputs['end_time'];
        $recurrence_data       = $inputs['recurrence'][$inputs['schedule']] ?? null;
        $this->start_date      = $inputs['start_date'];
        $this->end_after       = $inputs['end_type'] === '2' ? $inputs['end_after'] : null;
        $this->end_date        = $inputs['end_type'] === '1' ? $inputs['end_date'] : null;
        $this->every           = $recurrence_data['every'] ?? null;
        $this->start_time      = $inputs['start_time'] ?? null;
        $this->schedule        = (int) $inputs['schedule'];
        $this->recurrence_type = $recurrence_data['recurrence_type'] ?? null;
        $this->every_on        = null;
        $this->day             = null;
        $this->week            = $recurrence_data['week'] ?? null;
        $this->dow             = $recurrence_data['dow'] ?? null;
        $this->month           = $recurrence_data['month'] ?? null;

        if ($recurrence_data && isset($recurrence_data['day']) && is_array($recurrence_data['day'])) {
            $this->every_on = implode(',', $recurrence_data['day']);
        }

        if ($recurrence_data && isset($recurrence_data['day']) && !is_array($recurrence_data['day'])) {
            $this->day = $recurrence_data['day'];
        }

        if (isset($inputs['start_time'])) {
            $this->duration = strtotime($inputs['end_datetime']) - strtotime($this->start_date.'T'.$inputs['start_time']);
        } else {
            $this->duration = null;
        }

        $this->assignee_id   = $assignee->id;
        $this->assignee_type = $assignee::class;
        $this->generates     = $generates;
        $this->save();

        GenerateScheduleDates::dispatch($this, tenant());
    }

    // Relations
    public function assignee()
    {
        return $this->morphTo();
    }

    public function dates(): HasMany
    {
        return $this->hasMany(ScheduleDate::class);
    }

    public function generates()
    {
        return $this->morphTo();
    }
}
