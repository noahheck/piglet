<?php

namespace App\Traits\User;

use DateTime;

trait FormatsDates
{
    /**
     * Only formats date, not time, so no timezone conversion needs to take place
     * @param DateTime|null $date
     * @return string
     */
    public function formatDate(DateTime $date = null)
    {
        if (!$date) {
            return "";
        }

        return $date->setTime(0,0)->format("m/d/Y");
    }
}
