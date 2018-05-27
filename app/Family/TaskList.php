<?php

namespace App\Family;



class TaskList extends Model
{
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
}
