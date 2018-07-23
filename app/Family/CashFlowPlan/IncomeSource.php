<?php

namespace App\Family\CashFlowPlan;

use App\Family\CashFlowPlan;
use App\Family\Model;

class IncomeSource extends Model
{
    protected $table = 'cash_flow_plan_income_sources';

    protected $typeDescriptions = [
        'budget' => 'Budgeted',
        'actual' => 'Actual',
    ];

    public function typeDescription()
    {
        return $this->typeDescriptions[$this->type];
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
