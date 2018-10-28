<?php

namespace App\Family;

use App\Family;
use App\Family\CashFlowPlan\Expense;
use App\Family\CashFlowPlan\ExpenseGroup;
use App\Family\CashFlowPlan\PiggyBank;
use App\Family\CashFlowPlan\PiggyBankContribution;
use App\Family\CashFlowPlan\RecurringExpense;
use App\Interfaces\Definitions\Charts;
use App\Interfaces\Definitions\Settings;
use App\Traits\CashFlowPlan\ProvidesChartData;
use App\Traits\CashFlowPlan\StoresLifestyleExpenses;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Family\CashFlowPlan\IncomeSource;

use function App\formatCurrency;

class CashFlowPlan extends Model
{
    use SoftDeletes,
        StoresLifestyleExpenses,
        ProvidesChartData
    ;



    public function incomeSources()
    {
        return $this->hasMany(IncomeSource::class);
    }

    public function projectedIncomeSourcesTotal()
    {
        return $this->incomeSources->sum('projected');
    }

    public function actualIncomeSourcesTotal()
    {
        return $this->incomeSources->sum('actual');
    }



    public function balance()
    {
        return $this->actualIncomeSourcesTotal() - $this->allExpendituresTotal();
    }

    public function allExpendituresTotal()
    {
        return    $this->allActualExpensesTotal()
                + $this->lifestyleExpensesTotal()
                + $this->actualPiggyBankContributionsTotal()
            ;
    }






    public function recurringExpenses()
    {
        return $this->hasMany(RecurringExpense::class);
    }

    public function projectedRecurringExpensesTotal()
    {
        return $this->recurringExpenses->sum('projected');
    }

    public function actualRecurringExpensesTotal()
    {
        return $this->recurringExpenses->sum('actual');
    }

    public function recurringExpensesActualVsProjected()
    {
        return $this->actualRecurringExpensesTotal() - $this->projectedRecurringExpensesTotal();
    }

    public function recurringExpensesOverspent()
    {
        return $this->actualRecurringExpensesTotal() > $this->projectedRecurringExpensesTotal();
    }

    public function recurringExpensesCloseToOverspent()
    {
        return (($this->actualRecurringExpensesTotal() / $this->projectedRecurringExpensesTotal()) * 100) >= 90;
    }





    public function hasRecurringExpensesForCategory($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->count() > 0;
    }

    public function recurringExpenseCategoryProjectedTotal($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->sum('projected');
    }

    public function recurringExpenseCategoryActualTotal($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->sum('actual');
    }

    public function recurringExpenseCategoryActualVsProjected($categoryId = null)
    {
        return    $this->recurringExpenseCategoryActualTotal($categoryId)
                - $this->recurringExpenseCategoryProjectedTotal($categoryId);
    }

    public function recurringExpenseCategoryPercentUtilized($categoryId = null)
    {
        if (!$this->recurringExpenseCategoryProjectedTotal($categoryId)) {
            return null;
        }

        return (
                  $this->recurringExpenseCategoryActualTotal($categoryId)
                / $this->recurringExpenseCategoryProjectedTotal($categoryId)
            ) * 100;
    }

    public function recurringExpenseCategoryIsOverspent($categoryId = null)
    {
        return $this->recurringExpenseCategoryPercentUtilized($categoryId) > 100;
    }

    public function recurringExpenseCategoryIsCloseToOverspent($categoryId = null)
    {
        return $this->recurringExpenseCategoryPercentUtilized($categoryId) >= 90;
    }

    public function recurringExpenseCategoryPaymentsMade($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->reduce(function($carry, $expense) {
            return ($expense->actual) ? ++$carry : $carry;
        }, 0);
    }

    public function recurringExpenseCategoryPaymentsExpected($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->count();
    }

    public function recurringExpenseCategoryAllPaymentsMade($categoryId = null)
    {
        return  $this->recurringExpenseCategoryPaymentsMade($categoryId)
            === $this->recurringExpenseCategoryPaymentsExpected($categoryId);
    }

    public function recurringExpenseCategoryPercentPaymentsMade($categoryId = null)
    {
        if (!$this->recurringExpenseCategoryPaymentsExpected($categoryId)) {
            return null;
        }

        return (
                  $this->recurringExpenseCategoryPaymentsMade($categoryId)
                / $this->recurringExpenseCategoryPaymentsExpected($categoryId)
            ) * 100;
    }



    public function hasExpenseGroupTemplate($template)
    {
        return $this->expenseGroups->pluck('expense_group_id')->contains($template->id);
    }

    public function hasRecurringExpense($template)
    {
        return $this->recurringExpenses->pluck('recurring_expense_id')->contains($template->id);
    }




    public function allActualExpensesTotal()
    {
        return $this->actualRecurringExpensesTotal() + $this->actualExpensesTotal();
    }







    public function expenseGroups()
    {
        return $this->hasMany(ExpenseGroup::class);
    }

    public function expenseGroupsProjectedTotal()
    {
        return $this->expenseGroups->sum('projected');
    }




    public function expenses()
    {
        return $this->hasMany(Expense::class)->orderBy('date');
    }

    public function actualExpensesTotal()
    {
        return $this->expenses->sum('actual');
    }





    public function expenseGroupsActualVsProjected()
    {
        return $this->actualExpensesTotal() - $this->expenseGroupsProjectedTotal();
    }

    public function expenseGroupsOverspent()
    {
        return $this->expenseGroupsActualVsProjected() > 0;
    }












    public function piggyBanks()
    {
        return $this->hasMany(PiggyBank::class);
    }








    public function piggyBankContributions()
    {
        return $this->hasMany(PiggyBankContribution::class);
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
