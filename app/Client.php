<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $appends = ['contact_name', 'address'];

    public function getContactNameAttribute(){
        return $this->attributes['first_name'].' '.$this->attributes['surname'];
    }
    public function getAddressAttribute(){
        return $this->attributes['address1'].' '.$this->attributes['address2'].' '.$this->attributes['county'].' '.$this->attributes['country'];
    }

    public function properties() {
        return $this->hasMany(Property::class, 'client_id', 'id');
    }
}
