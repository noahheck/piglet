<?php

namespace App\Traits;

trait HasSecondaryPhoneNumber
{
    use FormatsPhoneNumbers;

    public function setSecondaryPhoneAttribute($number)
    {
        $this->attributes['secondaryPhone'] = $this->formatForDatabase($number);
    }

    public function getSecondaryPhoneAttribute()
    {
        return $this->formatForOutput($this->attributes['secondaryPhone']);
    }
}
