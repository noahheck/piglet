<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    protected $casts = [
        'active' => 'boolean',
        'completed' => 'date',
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

    public function isPrivate()
    {
        return $this->private;
    }
}
