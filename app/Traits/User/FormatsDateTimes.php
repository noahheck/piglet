<?php

namespace App\Traits\User;

use DateTime;

trait FormatsDateTimes
{
    /**
     * Only formats date, not time, so no timezone conversion needs to take place
     * @param DateTime|null $date
     * @return string
     */
    public function formatDateTime(DateTime $datetime = null, $format = null)
    {
        if (!$datetime) {
            return "";
        }

        return $datetime->setTimezone($this->timezone)->format('m/d/Y g:i A');
    }
}
