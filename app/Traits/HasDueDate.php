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

        return $this->attributes['dueDate'] = Carbon::createFromFormat('m/d/Y', $dueDate)->setTime(0,0,0);
    }

    /**
     * Whether the item is due today
     *
     * @return bool
     */
    public function isDueToday()
    {
        $dueDate = $this->dueDate;

        if (!$dueDate) {

            return false;
        }

        $now = Carbon::now()->setTime(0,0,0);

        return $dueDate->eq($now);
    }

    /**
     * Whether the item is past due
     *
     * @return bool
     */
    public function isOverdue()
    {
        $dueDate = $this->dueDate;

        if (!$dueDate) {

            return false;
        }

        $now = Carbon::now()->setTime(0,0,0);

        return $dueDate->lt($now);
    }
}
