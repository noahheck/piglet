<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\Category;
use App\Family\ExpenseGroup;
use App\Family\IncomeSource;
use App\Family\Merchant;
use App\Family\MoneyMattersCharts;
use App\Family\PiggyBank;
use App\Family\RecurringExpense;
use function App\flashSuccess;
use function App\flashWarning;
use App\Http\Controllers\Controller;

use App\Interfaces\Definitions\Settings;
use Illuminate\Http\Request;

class MoneyMattersWelcomeController extends Controller
{
    public function index(Request $request, Family $family)
    {
        /*if ($family->getSetting(Settings::MONEY_MATTERS_FIRST_RUN_WIZARD_COMPLETE)) {
            flashWarning('money-matters-welcome.already-completed');

            return redirect()->route('family.money-matters', [$family]);
        }*/

        return view('family.money-matters-welcome', [
            'family' => $family,
        ]);
    }



    public function assemble(Request $request, Family $family)
    {
        if ($family->getSetting(Settings::MONEY_MATTERS_FIRST_RUN_WIZARD_COMPLETE)) {
            flashWarning('money-matters-welcome.already-completed');

            return redirect()->route('family.money-matters', [$family]);
        }

        // Income Sources
        $incomeSourcesNames   = $request->get('income_sources_name');
        $incomeSourcesAmounts = $request->get('income_sources_default_amount');

        $incomeSources = array_combine($incomeSourcesNames, $incomeSourcesAmounts);

        foreach ($incomeSources as $name => $amount) {

            if (!$name) {
                continue;
            }

            $incomeSource = new IncomeSource();

            $incomeSource->name           = $name;
            $incomeSource->default_amount = $amount;

            $incomeSource->active         = true;

            $incomeSource->save();
        }



        // Lifestyle Expenses
        foreach ($request->only([
            Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT,
            Family::MONEY_MATTERS_RETIREMENT_AMOUNT,
            Family::MONEY_MATTERS_EDUCATION_AMOUNT,
        ]) as $setting => $value) {

            $value = $value ?: '0';

            $family->setSetting($setting, $value);
        }



        // Recurring Expenses
        $recurringExpenseOptions = [
            // Housing
            'mortgage' => [
                'category'    => '2',
                'subCategory' => __('categories.expense.mortgage'),
                'expenseName' => __('categories.expense.mortgage.description'),
            ],
            'rent' => [
                'category'    => '2',
                'subCategory' => __('categories.expense.rent'),
                'expenseName' => __('categories.expense.rent.description'),
            ],
            'hoa' => [
                'category'    => '2',
                'subCategory' => __('categories.expense.hoa'),
                'expenseName' => __('categories.expense.hoa.description'),
            ],
            // Utilities
            'electricity' => [
                'category'    => '3',
                'subCategory' => __('categories.expense.electricity'),
                'expenseName' => __('categories.expense.electricity.description'),
            ],
            'gas' => [
                'category'    => '3',
                'subCategory' => __('categories.expense.gas'),
                'expenseName' => __('categories.expense.gas.description'),
            ],
            'water' => [
                'category'    => '3',
                'subCategory' => __('categories.expense.water'),
                'expenseName' => __('categories.expense.water.description'),
            ],
            'phone' => [
                'category'    => '3',
                'subCategory' => __('categories.expense.phone'),
                'expenseName' => __('categories.expense.phone.description'),
            ],
            'cable' => [
                'category'    => '3',
                'subCategory' => __('categories.expense.cable'),
                'expenseName' => __('categories.expense.cable.description'),
            ],
            'internet' => [
                'category'    => '3',
                'subCategory' => __('categories.expense.internet'),
                'expenseName' => __('categories.expense.internet.description'),
            ],
            // Transportation
            'bus' => [
                'category'    => '4',
                'subCategory' => __('categories.expense.bus'),
                'expenseName' => __('categories.expense.bus.description'),
            ],
            'car1' => [
                'category'    => '4',
                'subCategory' => __('categories.expense.car'),
                'expenseName' => __('categories.expense.car.description'),
            ],
            'car2' => [
                'category'    => '4',
                'subCategory' => __('categories.expense.car'),
                'expenseName' => __('categories.expense.car.description'),
            ],
            // Insurance
            'medical' => [
                'category'    => '7',
                'subCategory' => __('categories.expense.medical'),
                'expenseName' => __('categories.expense.medical.description'),
            ],
            'dental' => [
                'category'    => '7',
                'subCategory' => __('categories.expense.dental'),
                'expenseName' => __('categories.expense.dental.description'),
            ],
            'vision' => [
                'category'    => '7',
                'subCategory' => __('categories.expense.vision'),
                'expenseName' => __('categories.expense.vision.description'),
            ],
            'life' => [
                'category'    => '7',
                'subCategory' => __('categories.expense.life'),
                'expenseName' => __('categories.expense.life.description'),
            ],
            'automobile' => [
                'category'    => '7',
                'subCategory' => __('categories.expense.automobile'),
                'expenseName' => __('categories.expense.automobile.description'),
            ],
        ];

        foreach ($recurringExpenseOptions as $key => $options) {

            $merchant = false;

            $merchantName  = $request->get('recurring_expenses_' . $key . '_merchant');
            $expenseAmount = $request->get('recurring_expenses_' . $key . '_amount');

            if (!$merchantName && !$expenseAmount) {
                continue;
            }


            if ($merchantName) {

                $merchant = new Merchant();

                $merchant->name                 = $merchantName;
                $merchant->default_category_id  = $options['category'];
                $merchant->default_sub_category = $options['subCategory'];

                $merchant->save();
            }


            $recurringExpense = new RecurringExpense();

            $recurringExpense->name           = $options['expenseName'];
            $recurringExpense->default_amount = $expenseAmount;
            $recurringExpense->category_id    = $options['category'];
            $recurringExpense->sub_category   = $options['subCategory'];

            if ($merchant) {
                $recurringExpense->merchant_id = $merchant->id;
            }

            $recurringExpense->active = true;

            $recurringExpense->save();


        }



        // Expense Groups
        $expenseGroupOptions = [
            'food' => [
                'category' => '1',
                'name'     => __('categories.expense-group.food'),
                'merchantsOptions' => [
                    'grocers' => [
                        'subCategory' =>  __('categories.expense-group.food.groceries'),
                    ],
                    'restaurants' => [
                        'subCategory' =>  __('categories.expense-group.food.restaurants'),
                    ],
                ],
            ],
            'gas' => [
                'category' => '4',
                'name'     =>  __('categories.expense-group.gas'),
                'merchantsOptions' => [
                    'gasstations' => [
                        'subCategory' =>  __('categories.expense-group.gas.fuel'),
                    ]
                ],
            ],
            'household' => [
                'category' => '5',
                'name'     =>  __('categories.expense-group.household'),
                'merchantsOptions' => [
                    'householdsuppliers' => [
                        'subCategory' =>  __('categories.expense-group.household.supplies'),
                    ],
                ],
            ],
            'stuff' => [
                'category' => '',
                'name'     =>  __('categories.expense-group.stuff'),
                'merchantsOptions' => [],
            ],
        ];

        foreach ($expenseGroupOptions as $key => $options) {
            $expenseGroup = new ExpenseGroup();

            $expenseGroup->name           = $options['name'];
            $expenseGroup->default_amount = $request->get('expense_groups_' . $key . '_amount');
            $expenseGroup->category_id    = $options['category'];

            $expenseGroup->active = true;

            $expenseGroup->save();

            foreach ($options['merchantsOptions'] as $type => $details) {

                $merchants = $request->get('expense_groups_' . $type);

                foreach ($merchants as $merchantName) {

                    if (!$merchantName) {
                        continue;
                    }

                    $merchant = new Merchant();

                    $merchant->name                 = $merchantName;
                    $merchant->default_category_id  = $options['category'];
                    $merchant->default_sub_category = $details['subCategory'];

                    $merchant->save();
                }
            }
        }



        // Piggy Banks
        $piggyBankOptions = [1,2,3];

        foreach ($piggyBankOptions as $piggyBankNum) {
            $name     = $request->get('piggy_bank_' . $piggyBankNum . '_name');
            $target   = $request->get('piggy_bank_' . $piggyBankNum . '_target');
            $starting = $request->get('piggy_bank_' . $piggyBankNum . '_starting');
            $monthly  = $request->get('piggy_bank_' . $piggyBankNum . '_monthly');
            $dueDate  = $request->get('piggy_bank_' . $piggyBankNum . '_dueDate');

            if (!$name) {
                continue;
            }

            $piggyBank = new PiggyBank();

            $piggyBank->name                 = $name;
            $piggyBank->starting_amount      = $starting;
            $piggyBank->target_amount        = $target;
            $piggyBank->monthly_contribution = $monthly;
            $piggyBank->dueDate              = $dueDate;

            $piggyBank->save();
        }



        $family->setSetting(Family::MONEY_MATTERS_FIRST_RUN_WIZARD_COMPLETE, true);

        flashSuccess('money-matters-welcome.wizard-completed');

        return redirect()->route('family.money-matters', [$family]);
    }
}
