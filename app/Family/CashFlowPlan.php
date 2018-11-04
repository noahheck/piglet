<?php

namespace App\Family;

use App\Family\CashFlowPlan\Expense;
use App\Family\CashFlowPlan\ExpenseGroup;
use App\Family\CashFlowPlan\IncomeSource;
use App\Family\CashFlowPlan\PiggyBank;
use App\Family\CashFlowPlan\PiggyBankContribution;
use App\Family\CashFlowPlan\RecurringExpense;
use App\Traits\CashFlowPlan\ProcessesExpenseGroups;
use App\Traits\CashFlowPlan\ProcessesIncomeSources;
use App\Traits\CashFlowPlan\ProcessesPiggyBankContributions;
use App\Traits\CashFlowPlan\ProcessesRecurringExpenses;
use App\Traits\CashFlowPlan\ProvidesChartData;
use App\Traits\CashFlowPlan\StoresLifestyleExpenses;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;



class CashFlowPlan extends Model
{
    use SoftDeletes,
        StoresLifestyleExpenses,
        ProvidesChartData,
        ProcessesIncomeSources,
        ProcessesRecurringExpenses,
        ProcessesExpenseGroups,
        ProcessesPiggyBankContributions
    ;

    protected $casts = [
        'pocket_money_distributed' => 'boolean',
        'retirement_distributed'   => 'boolean',
        'education_distributed'    => 'boolean',
    ];



    public function incomeSources()
    {
        return $this->hasMany(IncomeSource::class);
    }

    public function recurringExpenses()
    {
        return $this->hasMany(RecurringExpense::class);
    }

    public function expenseGroups()
    {
        return $this->hasMany(ExpenseGroup::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class)->orderBy('date');
    }

    public function piggyBanks()
    {
        return $this->hasMany(PiggyBank::class);
    }

    public function piggyBankContributions()
    {
        return $this->hasMany(PiggyBankContribution::class);
    }



    public function monthAsDateTime()
    {
        $dateString = $this->year . '-' . $this->month . '-01';

        return new Carbon($dateString);
    }


    public function isOverspent()
    {
        return $this->balance() < 0;
    }

    public function balance()
    {
        return $this->actualIncomeSourcesTotal() - $this->allExpendituresTotal();
    }

    public function allExpendituresTotal()
    {
        return    $this->allActualExpensesTotal()
                + $this->distributedLifestyleExpensesTotal()
                + $this->actualPiggyBankContributionsTotal()
            ;
    }

    public function allActualExpensesTotal()
    {
        return $this->actualRecurringExpensesTotal() + $this->actualExpensesTotal();
    }

    public function actualExpensesTotal()
    {
        return $this->expenses->sum('actual');
    }

    public function expenseGroupsActualVsProjected()
    {
        return $this->actualExpensesTotal() - $this->expenseGroupsProjectedTotal();
    }



    public function projectedBalance()
    {
        return $this->projectedIncomeSourcesTotal() - $this->allProjectedExpendituresTotal();
    }

    public function allProjectedExpendituresTotal()
    {

        return   $this->allProjectedExpensesTotal()
               + $this->projectedLifestyleExpensesTotal()
               + $this->projectedPiggyBankTotal();
    }

    public function allProjectedExpensesTotal()
    {
        return $this->projectedRecurringExpensesTotal() + $this->expenseGroupsProjectedTotal();
    }



    /**
     * @param $year
     * @param $month
     * @param array $lifestyleExpenses
     * @param Collection $incomeSources
     * @param Collection $piggyBanks
     * @param Collection $recurringExpenses
     * @param Collection $expenseGroups
     * @return CashFlowPlan
     */
    public static function createNew($year, $month, $lifestyleExpenses, $incomeSources, $piggyBanks, $recurringExpenses, $expenseGroups)
    {
        $cashFlowPlan = new CashFlowPlan();

        $cashFlowPlan->year    = $year;
        $cashFlowPlan->month   = $month;
        $cashFlowPlan->details = '';

        $cashFlowPlan->pocket_money = $lifestyleExpenses['pocket-money'];
        $cashFlowPlan->retirement   = $lifestyleExpenses['retirement'];
        $cashFlowPlan->education    = $lifestyleExpenses['education'];

        $cashFlowPlan->save();

        $incomeSources->each(function($incomeSourceTemplate) use ($cashFlowPlan) {
            $incomeSource = new IncomeSource();

            $incomeSource->cash_flow_plan_id = $cashFlowPlan->id;
            $incomeSource->fill([
                'income_source_id' => $incomeSourceTemplate->id,
                'name'             => $incomeSourceTemplate->name,
                'projected'        => $incomeSourceTemplate->default_amount,
            ]);

            $incomeSource->save();
        });

        $piggyBanks->each(function($piggyBank) use ($cashFlowPlan) {

            $monthlyPiggyBank = new PiggyBank();

            $monthlyPiggyBank->cash_flow_plan_id = $cashFlowPlan->id;
            $monthlyPiggyBank->fill([
                'piggy_bank_id' => $piggyBank->id,
                'projected'     => $piggyBank->monthly_contribution,
            ]);

            $monthlyPiggyBank->save();
        });

        $recurringExpenses->each(function($recurringExpenseTemplate) use ($cashFlowPlan) {
            $recurringExpense = new RecurringExpense();

            $recurringExpense->cash_flow_plan_id = $cashFlowPlan->id;
            $recurringExpense->fill([
                'recurring_expense_id' => $recurringExpenseTemplate->id,
                'merchant_id'          => $recurringExpenseTemplate->merchant_id,
                'category_id'          => $recurringExpenseTemplate->category_id,
                'sub_category'         => $recurringExpenseTemplate->sub_category,
                'name'                 => $recurringExpenseTemplate->name,
                'projected'            => $recurringExpenseTemplate->default_amount,
            ]);

            $recurringExpense->save();
        });

        $expenseGroups->each(function($expenseGroupTemplate) use ($cashFlowPlan) {
            $expenseGroup = new ExpenseGroup();

            $expenseGroup->cash_flow_plan_id = $cashFlowPlan->id;
            $expenseGroup->fill([
                'expense_group_id' => $expenseGroupTemplate->id,
                'category_id'      => $expenseGroupTemplate->category_id,
                'sub_category'     => $expenseGroupTemplate->sub_category,
                'name'             => $expenseGroupTemplate->name,
                'projected'        => $expenseGroupTemplate->default_amount,
            ]);

            $expenseGroup->save();
        });

        return $cashFlowPlan;
    }
}
