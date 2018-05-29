<?php

namespace App\Family;

use App\Family\TaskList;
use App\Family\Member;

use App\Traits\HasDueDate;

class Task extends Model
{
    use HasDueDate;

    protected $fillable = [
        'title',
        'details',
        'dueDate',
        'active',
        'member_id',
    ];

    protected $casts = [
        'active' => 'boolean',
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
