<?php

namespace App\Family\CashFlowPlan;

use App\Family\Category;
use App\Family\Merchant;
use App\Family\Model;
use App\Traits\HasDateField;
use App\Traits\HasUnchangeableProperties;
use App\Traits\PopulatesCashFlowPlan;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Family\CashFlowPlan;

class RecurringExpense extends Model
{
    use SoftDeletes,
        HasDateField,
        PopulatesCashFlowPlan,
        HasUnchangeableProperties
    ;

    protected $table = 'cash_flow_plan_recurring_expenses';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'recurring_expense_id',
        'merchant_id',
        'category_id',
        'sub_category',
        'name',
        'projected',
        'actual',
        'date',
        'payment_detail',
        'detail',
    ];

    protected $unchangeable = [
        'recurring_expense_id',
        'merchant_id',
        'category_id',
        'sub_category',
        'name',
    ];

    public static function getValidations()
    {
        return [
            'recurring_expense_id' => 'required|integer',
            'date'                 => 'date|nullable',
            'projected'            => 'numeric|nullable',
            'actual'               => 'numeric|nullable',
        ];
    }

    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }

    public function recurringExpenseTemplate()
    {
        return $this->belongsTo(\App\Family\RecurringExpense::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function hasMissingProjectedValue()
    {
        return $this->projected == 0 && $this->actual == 0;
    }

    public function isFulfilled()
    {
        return ($this->actual) ? true : false;
    }

    public function title()
    {
        $title = '';

        if ($this->merchant) {
            $title .= ($title) ? ' - ' . $this->merchant->name : $this->merchant->name;
        }

        $title = ($title) ? $title : __('expenses.no-merchant');

        return $title;
    }
}
