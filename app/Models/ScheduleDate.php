<?php

namespace Fuse\Models;

use Fuse\Helpers\Dates;
use Fuse\Observers\ScheduleDateObserver;
use Fuse\Traits\BaseModel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[ObservedBy(ScheduleDateObserver::class)]
class ScheduleDate extends Model
{
    use BaseModel;

    protected $fillable = [
        'date',
        'schedule_id',
    ];
    public $timestamps = false;
    public $with       = ['schedule'];

    // Attributes
    public function dateTime(): Attribute
    {
        return new Attribute(
            get: function () {
                $start = now()->parse($this->date.' '.$this->schedule->start_time);
                $end   = $start->clone()->addSeconds($this->schedule->duration);

                return [
                    'start' => [
                        'date'      => Dates::date($start),
                        'date_time' => Dates::datetime($start),
                        'time'      => Dates::time($start),
                    ],
                    'end' => [
                        'date'      => Dates::date($end),
                        'date_time' => Dates::datetime($end),
                        'time'      => Dates::time($end),
                    ],
                ];
            }
        );
    }

    public function nextDate(): Attribute
    {
        return new Attribute(
            get: fn () => ScheduleDate::where([
                ['id', '>', $this->id],
                ['date', '>', $this->date],
                'schedule_id' => $this->schedule_id,
            ])->orderBy('id')->first(),
        );
    }

    public function previousDate(): Attribute
    {
        return new Attribute(
            get: fn () => ScheduleDate::where([
                ['id', '<', $this->id],
                ['date', '<', $this->date],
                'schedule_id' => $this->schedule_id,
            ])->orderBy('id', 'desc')->first(),
        );
    }

    protected function route(): Attribute
    {
        return new Attribute(fn () => null);
    }

    // Casts

    // Relations
    public function generated(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function defaultSort(): array
    {
        return [
            'date' => 'asc',
        ];
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
}
