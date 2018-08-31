<?php

namespace App\Family\CashFlowPlan;

use App\Family\CashFlowPlan;
use App\Family\Category;
use App\Family\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseGroup extends Model
{
    use SoftDeletes;

    protected $table = 'cash_flow_plan_expense_groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'expense_group_id',
        'category_id',
        'sub_category',
        'name',
        'projected',
    ];

    public static function getValidations()
    {
        return [
            'name'             => 'required',
            'expense_group_id' => 'integer|nullable',
            'projected'        => 'numeric|nullable',
        ];
    }

    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }

    public function expenseGroupTemplate()
    {
        return $this->belongsTo(\App\Family\ExpenseGroup::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
