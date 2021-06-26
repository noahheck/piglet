<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasBirthdate
{
    public function age()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function setBirthdateAttribute($birthdate)
    {
        if (!$birthdate) {
            return $this->attributes['birthdate'] = null;
        }

        return $this->attributes['birthdate'] = Carbon::createFromFormat('m/d/Y', $birthdate);
    }

    public function getDateOfBirthAttribute()
    {
        if (!isset($this->attributes['birthdate'])|| !$this->attributes['birthdate']) {

            return '';
        }

        $date = new \Carbon\Carbon($this->birthdate);

        return $date->format('m/d/Y');
    }

    public function getAgeAttribute()
    {
        return $this->age();
    }
}
