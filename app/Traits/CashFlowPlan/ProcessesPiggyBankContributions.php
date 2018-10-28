<?php

namespace App\Traits\CashFlowPlan;


trait ProcessesPiggyBankContributions
{
    public function projectedPiggyBankContributionsTotal()
    {
        return $this->piggyBankContributions->sum('projected');
    }

    public function actualPiggyBankContributionsTotal()
    {
        return $this->piggyBankContributions->sum('actual');
    }

    public function actualPiggyBankContributionsForPiggyBankTotal($piggyBank)
    {
        return $this->piggyBankContributions->where('piggy_bank_id', $piggyBank->id)->sum('actual');
    }

    public function projectedPiggyBankContributionsForPiggyBankTotal($piggyBank)
    {
        return $this->piggyBankContributions->where('piggy_bank_id', $piggyBank->id)->sum('projected');
    }
}