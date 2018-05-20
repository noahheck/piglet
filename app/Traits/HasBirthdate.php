<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasBirthdate
{
    public function age()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function getAgeAttribute()
    {
        return $this->age();
    }
}
