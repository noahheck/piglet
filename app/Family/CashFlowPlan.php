<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Family\CashFlowPlan\IncomeSource;

class CashFlowPlan extends Model
{
    use SoftDeletes
        ;

    public function incomeSources()
    {
        return $this->hasMany(IncomeSource::class);
    }

    public function budgetIncomeSourcesTotal()
    {
        return $this->incomeSources->where('type', 'budget')->sum('amount');
    }

    public function actualIncomeSourcesTotal()
    {
        return $this->incomeSources->where('type', 'actual')->sum('amount');
    }
}
