<?php

namespace App\Family;

use App\Family\TaskList;
use App\Family\Member;

use App\Traits\HasDueDate;

class Task extends Model
{
    use HasDueDate;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'dueDate',
        'scheduledDate',
        'completedDate',
    ];



    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
