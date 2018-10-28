<?php

namespace App\Traits\CashFlowPlan;


trait ProcessesIncomeSources
{

    public function projectedIncomeSourcesTotal()
    {
        return $this->incomeSources->sum('projected');
    }

    public function actualIncomeSourcesTotal()
    {
        return $this->incomeSources->sum('actual');
    }

}