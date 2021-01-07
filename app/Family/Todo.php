<?php

namespace App\Family;

use App\Traits\HasDueDate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    protected $casts = [
        'active' => 'boolean',
        'created_by' => 'integer',
    ];

    public function scopeOrdered($query)
    {
        return $query
            ->orderBy('completed', 'ASC')
            ->orderBy('due_date', 'ASC');
    }

    public function createdBy()
    {
        return $this->belongsTo(Member::class, 'created_by');
    }

    public function isDueToday()
    {
        if ($this->completed) {

            return false;
        }

        if (!$this->due_date) {

            return false;
        }

        $today = \Auth::user()->today()->setTime(0, 0, 0);

        $dueDate = Carbon::createFromFormat("m/d/Y", $this->due_date, $today->timezone)
                    ->setTime(0, 0, 0);

        return $today->eq($dueDate);
    }

    public function isOverdue()
    {
        if ($this->completed) {

            return false;
        }

        if (!$this->due_date) {

            return false;
        }

        $today = \Auth::user()->today()->setTime(0, 0, 0);

        $dueDate = Carbon::createFromFormat("m/d/Y", $this->due_date, $today->timezone)
                    ->setTime(0, 0, 0);

        return $dueDate->lt($today);
    }

    public function isPrivate()
    {
        return $this->private;
    }
}
