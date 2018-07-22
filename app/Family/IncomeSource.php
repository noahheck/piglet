<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeSource extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'default_amount',
        'description',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public static function getValidations()
    {
        return [
            'name'           => 'required',
            'default_amount' => 'numeric|nullable',
        ];
    }

    public function incomeSourceInstances()
    {
        return $this->hasMany(\App\Family\CashFlowPlan\IncomeSource::class);
    }
}
