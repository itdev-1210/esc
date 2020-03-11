<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Job extends Model
{
    protected $appends = ['signature_src', 'is_activate', 'start_date_parse', 'complete_date_parse'];

    public function getSignatureSrcAttribute()
    {
        if ($this->attributes['signature']) {
            return asset('/storage/logos/'.$this->attributes['signature']);
        }

        return null;
    }

    public function getIsActivateAttribute()
    {
        if ($this->attributes['signature']) {
            return 'Sign';
        } else {
            return 'Not Sign';
        }
    }

    public function getStartDateParseAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('d/m/Y');
    }

    public function getCompleteDateParseAttribute()
    {
        return $this->attributes['customer_complete_date'] ? Carbon::parse($this->attributes['customer_complete_date'])->format('d/m/Y') : null;
        // return Carbon::parse($this->attributes['customer_complete_date'])->format('d/m/Y');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'client_id', 'id');
    }

    public function engineer()
    {
        return $this->belongsTo(Engineer::class, 'client_id', 'id');
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class, 'job_id', 'id');
    }
}
