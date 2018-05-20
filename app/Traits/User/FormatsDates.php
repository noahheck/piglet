<?php

namespace App\Traits\User;

use DateTime;

trait FormatsDates
{
    public function formatDate(DateTime $date)
    {
        return $date->format("m/d/Y");
    }
}
