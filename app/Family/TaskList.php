<?php

namespace App\Family;

use App\Family\Task;

use App\Traits\HasDueDate;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskList extends Model
{
    use HasDueDate,
        SoftDeletes;

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
        return $this->hasMany(Task::class)->with('member');
    }

    /**
     * Get the active, incomplete tasks for this list
     */
    public function activeTasks()
    {
        return $this->tasks->filter(function($task) {
            return $task->isActive();
        });
    }

    /**
     * Get the completed tasks for this list
     */
    public function completedTasks()
    {
        return $this->tasks->filter(function($task) {
            return $task->isCompleted();
        });
    }

    /**
     * Get the inactive tasks for this list
     */
    public function inactiveTasks()
    {
        return $this->tasks->filter(function($task) {
            return $task->isInactive();
        });
    }

    /**
     * Whether this list has any inactive tasks
     */
    public function hasInactiveTasks()
    {
        return ($this->inactiveTasks()->count() > 0) ? true : false;
    }






    /**
     * Get the tasks stats for this list
     */
    public function taskStats()
    {
        $numTotal = $this->tasks->count();

        $numInactive = $this->inactiveTasks()->count();

        $totalActive = $numTotal - $numInactive;

        $numCompleted = $this->completedTasks()->count();

        return [
            'total'     => $totalActive,
            'completed' => $numCompleted,
        ];
    }
}
