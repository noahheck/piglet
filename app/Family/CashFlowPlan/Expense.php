<?php

namespace App\Family\CashFlowPlan;

use App\Family\CashFlowPlan;
use App\Family\Category;
use App\Family\Merchant;
use App\Family\Model;
use App\Traits\HasDateField;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes,
        HasDateField
;

    protected $table = 'cash_flow_plan_expenses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date',
    ];

    protected $fillable = [
        'expense_group_id',
        'merchant_id',
        'category_id',
        'sub_category',
        'name',
        'actual',
        'date',
        'payment_detail',
        'description',
        'detail',
    ];

    public static function getValidations()
    {
        return [
            'expense_group_id' => 'integer',
            'merchant_id'      => 'integer|nullable',
            'category_id'      => 'integer|nullable',
            'actual'           => 'numeric|nullable',
            'date'             => 'date|nullable',
        ];
    }

    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }

    public function expenseGroup()
    {
        return $this->belongsTo(ExpenseGroup::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }



    public function title()
    {
        $title = '';

        if ($this->description) {
            $title = $this->description;
        }

        if ($this->merchant) {
            $title .= ($title) ? ' - ' . $this->merchant->name : $this->merchant->name;
        }

        $title = ($title) ? $title : __('expenses.no-merchant');

        return $title;
    }
}
