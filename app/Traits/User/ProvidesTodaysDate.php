<?php

namespace App\Traits\User;

use Carbon\Carbon;

trait ProvidesTodaysDate
{
    public function today()
    {
        return Carbon::now(new \DateTimeZone($this->timezone));
    }
}
