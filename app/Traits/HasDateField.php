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

        return $this->attributes['date'] = Carbon::createFromFormat('m/d/Y', $date);
    }
}
