<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $hidden = ['password'];

    protected $appends = ['company_logo_src', 'logo1_src', 'logo2_src', 'address'];

    public function getCompanyLogoSrcAttribute(){
        if ($this->attributes['company_logo'])
            return asset("/storage/logos/".$this->attributes['company_logo']);
        return null;
    }

    public function getLogo1SrcAttribute(){
        if ($this->attributes['logo1'])
            return asset("/storage/logos/".$this->attributes['logo1']);
        return null;
    }

    public function getLogo2SrcAttribute(){
        if ($this->attributes['logo2'])
            return asset("/storage/logos/".$this->attributes['logo2']);
        return null;
    }

    public function getAddressAttribute(){
        return $this->attributes['address_1'].' '.$this->attributes['address_2'].' '.$this->attributes['city'].' '.$this->attributes['county'].' '.$this->attributes['country'];
    }
}
