<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasDueDate
{
    public function setDueDateAttribute($dueDate)
    {
        if (!$dueDate) {
            return null;
        }

        return $this->attributes['dueDate'] = \Carbon\Carbon::createFromFormat('m/d/Y', $dueDate);
    }
}
