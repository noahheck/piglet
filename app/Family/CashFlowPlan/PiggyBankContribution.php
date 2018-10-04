<?php

namespace App\Family\CashFlowPlan;

use App\Family\CashFlowPlan;
use App\Family\Model;
use App\Family\PiggyBank;
use App\Traits\HasDateField;
use Illuminate\Database\Eloquent\SoftDeletes;

class PiggyBankContribution extends Model
{
    use SoftDeletes,
        HasDateField
        ;

    public function piggyBank()
    {
        return $this->belongsTo(PiggyBank::class);
    }

    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }
}
