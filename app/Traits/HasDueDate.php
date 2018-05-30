<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $dueDate = $this->dueDate;

        if (!$dueDate) {
            return false;
        }

        $tz = Auth::user()->timezone;

        $dueDate->endOfDay()->tz($tz);

        $now = Carbon::now($tz)->endOfDay()->tz($tz);

        return $now->diffInSeconds($dueDate) <= 0;
    }
}
