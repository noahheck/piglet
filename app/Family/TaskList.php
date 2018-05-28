<?php

namespace App\Family;

use App\Family\Task;

use App\Traits\HasDueDate;

class TaskList extends Model
{
    use HasDueDate;

    protected $fillable = [
        'title',
        'details',
        'dueDate',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public static function getValidations()
    {
        return [
            'title'   => 'required|max:255',
            'dueDate' => 'date|nullable',
        ];
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'dueDate',
    ];



    /**
     * Get the tasks for this list
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }



    /**
     * Get the tasks stats for this list
     */
    public function taskStats()
    {
        $numTotal = $this->tasks->count();

        $numActive = $this->tasks->filter(function($task) {
            return $task->active;
        })->count();

        return [
            'total' => $numTotal,
            'active' => $numActive,
        ];
    }
}
