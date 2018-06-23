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
        if (!isset($this->attributes['phone'])) {
            return '';
        }

        return $this->formatForOutput($this->attributes['phone']);
    }
}
