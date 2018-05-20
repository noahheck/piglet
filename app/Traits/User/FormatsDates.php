<?php

namespace App\Traits\User;

use DateTime;

trait FormatsDates
{
    public function formatDate(DateTime $date = null)
    {
        if (!$date) {
            return "";
        }

        return $date->format("m/d/Y");
    }
}
