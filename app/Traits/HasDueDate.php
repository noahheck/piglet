<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasDueDate
{
    public function setDueDateAttribute($dueDate)
    {
        if (!$dueDate) {
            return $this->attributes['dueDate'] = null;
        }

        return $this->attributes['dueDate'] = Carbon::createFromFormat('m/d/Y', $dueDate);
    }

    public function isOverdue()
    {
        /*$dueDate = $this->dueDate;

        if (!$dueDate) {
            return false;
        }*/

        return ($dueDate = $this->dueDate) && $dueDate < new \DateTime();
    }
}
