<?php

namespace App\Family;

use App\Traits\HasDueDate;
use Illuminate\Database\Eloquent\SoftDeletes;

class PiggyBank extends Model
{
    use SoftDeletes,
        HasDueDate
    ;

    protected $fillable = [
        'name',
        'starting_amount',
        'target_amount',
        'monthly_contribution',
        'description',
        'dueDate',
        'active',
        'completed',
    ];

    protected $casts = [
        'active'    => 'boolean',
        'completed' => 'boolean',
    ];

    public static function getValidations()
    {
        return [
            'name'                 => 'required|max:255',
            'dueDate'              => 'date|nullable',
            'target_amount'        => 'numeric|nullable',
            'starting_amount'      => 'numeric|nullable',
            'monthly_contribution' => 'numeric|nullable',
        ];
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'dueDate',
    ];

    public function getBalanceAttribute()
    {
        return $this->starting_amount;
    }

    public function getPercentCompletedAttribute()
    {
        return ($this->balance / $this->target_amount) * 100;
    }
}
