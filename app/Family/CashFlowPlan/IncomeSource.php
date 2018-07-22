<?php

namespace App\Family\CashFlowPlan;

use App\Family\CashFlowPlan;
use Illuminate\Database\Eloquent\Model;

class IncomeSource extends Model
{
    protected $table = 'cash_flow_plan_income_sources';


    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }

    public function incomeSourceTemplate()
    {
        return $this->belongsTo(\App\Family\IncomeSource::class);
    }
}
