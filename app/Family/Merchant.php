<?php

namespace App\Family;

use App\Family\CashFlowPlan\Expense;
use App\Interfaces\Definitions\Charts;
use App\Traits\HasAddress;
use App\Traits\HasPhoneNumber;
use App\Traits\HasSecondaryPhoneNumber;
use Illuminate\Database\Eloquent\SoftDeletes;

use function App\formatCurrency;

class Merchant extends Model
{
    use SoftDeletes,
        HasPhoneNumber,
        HasSecondaryPhoneNumber,
        HasAddress
    {
        HasPhoneNumber::formatForDatabase insteadof HasSecondaryPhoneNumber;
        HasPhoneNumber::formatForOutput insteadof HasSecondaryPhoneNumber;
    }

    protected $fillable = [
        'name',
        'default_category_id',
        'default_sub_category',
        'details',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'phone',
        'secondaryPhone',
        'url',
    ];

    public static function getValidations()
    {
        return [
            'name'                => 'required',
            'url'                 => 'url|nullable',
            'default_category_id' => 'integer|nullable',
        ];
    }



    public function defaultCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function recurringExpenses()
    {
        return $this->hasMany(RecurringExpense::class);
    }

    public function recurringExpenseInstances()
    {
        return $this->hasMany(\App\Family\CashFlowPlan\RecurringExpense::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }



    private $expensesLoaded = false;

    protected function loadExpenses()
    {
        if ($this->expensesLoaded) {
            return;
        }

        $this->expensesLoaded = true;

        $this->load('expenses');

        $this->expenses->load('cashFlowPlan');

        $this->load('recurringExpenseInstances');

        $this->recurringExpenseInstances->load('cashFlowPlan');
    }

    public function yearsWithExpenses()
    {
        $this->loadExpenses();

        $expenseCashFlowPlans = $this->expenses->filter(function($expense, $key) {

            return $expense->cashFlowPlan;
        })->pluck('cashFlowPlan');

        $recurringExpenseCashFlowPlans = $this->recurringExpenseInstances->filter(function($expense, $key) {

            return $expense->cashFlowPlan;
        })->pluck('cashFlowPlan');

        return collect([$expenseCashFlowPlans, $recurringExpenseCashFlowPlans])->flatten()->pluck('year')->unique();
    }

    public function expensesByYear($year)
    {
        $this->loadExpenses();

        $allExpenses = $this->expenses;

        $yearlyExpenses = $allExpenses->filter(function($expense, $key) use ($year) {
            return $expense->cashFlowPlan->year === $year;
        });



        $allRecurringExpenses = $this->recurringExpenseInstances;

        $yearlyRecurringExpenses = $allRecurringExpenses->filter(function($expense, $key) use ($year) {

            return $expense->cashFlowPlan &&  $expense->cashFlowPlan->year === $year;
        });



        $organizedByMonthExpenses = [];

        for ($x = 0; $x < 12; $x++) {

            $thisMonthsExpenses = $yearlyExpenses->filter(function($expense, $key) use ($x) {
                return $expense->cashFlowPlan->month == $x + 1;
            });

            $thisMonthsRecurringExpenses = $yearlyRecurringExpenses->filter(function($expense, $key) use ($x) {
                return $expense->cashFlowPlan->month == $x + 1;
            });



            $organizedByMonthExpenses[$x] = collect([$thisMonthsExpenses, $thisMonthsRecurringExpenses])->flatten();
        }

        return $organizedByMonthExpenses;
    }


    public function monthlyExpensesChartData($year)
    {
        $yearlyExpenses = $this->expensesByYear($year);

        $labels = [
            __('months.jan'),
            __('months.feb'),
            __('months.mar'),
            __('months.apr'),
            __('months.may'),
            __('months.jun'),
            __('months.jul'),
            __('months.aug'),
            __('months.sep'),
            __('months.oct'),
            __('months.nov'),
            __('months.dec'),
        ];

        $data = [
            0 => [
                'label' => __('expenses.expenses'),
                'backgroundColor' => Charts::BACKGROUND_COLOR_GREEN,
                'borderColor'     => Charts::BORDER_COLOR_GREEN,
            ],
        ];

        for ($x = 0; $x < 12; $x++) {

            $data[0]['data'][$x] = formatCurrency($yearlyExpenses[$x]->sum('actual'));

        }

        return [
            'type' => 'bar',
            'options' => [
                'scales' => [
                    'yAxes' => [[
                        'ticks' => [
                            'min' => 0,
                        ],
                    ]],
                ],
            ],
            'data' => [
                'labels'   => $labels,
                'datasets' => $data,
            ],
        ];
    }
}
