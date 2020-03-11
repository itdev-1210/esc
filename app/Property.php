<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $appends = ['contact_name', 'address'];

    public function getContactNameAttribute(){
        return $this->attributes['first_name'].' '.$this->attributes['surname'];
    }
    public function getAddressAttribute(){
        return $this->attributes['address1'].' '.$this->attributes['address2'].' '.$this->attributes['county'].' '.$this->attributes['country'];
    }

    public function client() {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function jobs() {
        return $this->hasMany(Job::class, 'property_id', 'id');
    }
}
