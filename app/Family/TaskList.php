<?php

namespace App\Family;



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
}
