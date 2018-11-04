<?php

namespace App\Traits\CashFlowPlan;


trait ProcessesPiggyBankContributions
{
    public function hasPiggyBank($piggyBank)
    {
        return $this->piggyBanks->pluck('piggy_bank_id')->contains($piggyBank->id);
    }

    public function projectedPiggyBankTotal()
    {
        return $this->piggyBanks->sum('projected');
    }

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