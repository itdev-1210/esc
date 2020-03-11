<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
    protected $appends = ['contact_name', 'address', 'signature_src', 'is_activate'];

    public function getContactNameAttribute(){
        return $this->attributes['first_name'].' '.$this->attributes['surname'];
    }
    public function getAddressAttribute(){
        return $this->attributes['address1'].' '.$this->attributes['address2'].' '.$this->attributes['county'].' '.$this->attributes['country'];
    }

    public function getSignatureSrcAttribute(){
        if ($this->attributes['signature'])
            return asset("/storage/logos/".$this->attributes['signature']);
        return null;
    }

    public function getIsActivateAttribute() {
        if ($this->attributes['signature']) return 'Active';
        else return 'Not Active';
    }

    public function jobs() {
        return $this->hasMany(Job::class, 'engineer_id', 'id');
    }
}
