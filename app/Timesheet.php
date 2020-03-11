<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Timesheet extends Model
{
    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('d/m/Y');
    }

    public function getStartTimeAttribute()
    {
        $time = Carbon::createFromFormat('H:i:s', $this->attributes['start_time']);

        return $time->format('H:i');
    }

    public function getEndTimeAttribute()
    {
        $time = Carbon::createFromFormat('H:i:s', $this->attributes['end_time']);

        return $time->format('H:i');
    }
}
