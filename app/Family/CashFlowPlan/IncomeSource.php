<?php

namespace App\Family\CashFlowPlan;

use App\Family\CashFlowPlan;
use App\Family\Model;

class IncomeSource extends Model
{
    protected $table = 'cash_flow_plan_income_sources';

    protected $fillable = [
        'income_source_id',
        'name',
        'type',
        'amount',
        'detail',
    ];

    public static function getValidations()
    {
        return [
            'name'             => 'required',
            'income_source_id' => 'integer|nullable',
            'type'             => 'required|in:budget,actual',
            'amount'           => 'numeric',
        ];
    }

    public static $typeDescriptions = [
        'budget' => 'Budgeted',
        'actual' => 'Actual',
    ];

    public function typeDescription()
    {
        return self::$typeDescriptions[$this->type];
    }


    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }

    public function incomeSourceTemplate()
    {
        return $this->belongsTo(\App\Family\IncomeSource::class);
    }
}
