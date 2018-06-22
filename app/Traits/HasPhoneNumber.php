<?php

namespace App\Traits;

trait HasPhoneNumber
{
    use FormatsPhoneNumbers;

    public function setPhoneAttribute($number)
    {
        $this->attributes['phone'] = $this->formatForDatabase($number);
    }

    public function getPhoneAttribute()
    {
        return $this->formatForOutput($this->attributes['phone']);
    }
}
