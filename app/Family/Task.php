<?php

namespace App\Family;

use App\Family\TaskList;
use App\Family\Member;

use App\Traits\HasDueDate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasDueDate,
        SoftDeletes;

    protected $fillable = [
        'title',
        'details',
        'dueDate',
        'active',
        'member_id',
    ];

    protected $casts = [
        'active'    => 'boolean',
        'completed' => 'boolean',
        'member_id' => 'integer',

    ];

    public static function getValidations()
    {
        return [
            'title'     => 'required|max:255',
            'dueDate'   => 'date|nullable',
            'member_id' => 'integer|nullable',
        ];
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'completed_at',
        'dueDate',
        'scheduledDate',
    ];



    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }



    public function isCompleted()
    {
        return $this->completed;
    }

    public function isActive()
    {
        return !$this->isCompleted() && $this->active;
    }

    public function isInactive()
    {
        return !$this->isCompleted() && !$this->active;
    }



    public function conclude()
    {
        if ($this->completed) {
            return $this;
        }

        $this->completed    = true;
        $this->completed_at = Carbon::now();

        return $this;
    }

    public function reopen()
    {
        if (!$this->completed) {
            return $this;
        }

        $this->completed    = false;
        $this->completed_at = null;

        return $this;
    }
}
