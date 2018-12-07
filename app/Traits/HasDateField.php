<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasDateField
{
    public function setDateAttribute($date)
    {
        if (!$date) {
            return $this->attributes['date'] = null;
        }

        if (is_object($date)) {
            return $this->attributes['date'] = $date;
        }

        return $this->attributes['date'] = Carbon::createFromFormat('m/d/Y', $date);
    }
}
