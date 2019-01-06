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

    protected $casts = [
        'cash' => 'boolean',
    ];

    protected $fillable = [
        'expense_group_id',
        'category_id',
        'sub_category',
        'name',
        'projected',
        'detail',
    ];

    public static function getValidations()
    {
        return [
            'name'             => 'required',
            'expense_group_id' => 'integer|nullable',
            'projected'        => 'numeric|nullable',
        ];
    }




    public function isOverspent()
    {
        return $this->actualTotal() > $this->projected;
    }

    public function isCloseToOverspent()
    {
        return $this->percentUtilized() >= 90;
    }

    public function percentUtilized()
    {
        if (!$this->projected) {
            return 0;
        }

        return ($this->actualTotal() / $this->projected) * 100;
    }

    public function actualTotal()
    {
        return $this->expenses->sum('actual');
    }

    public function actualVsProjected()
    {
        return $this->actualTotal() - $this->projected;
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

    public function expenses()
    {
        return $this->hasMany(Expense::class)->orderBy('date');
    }
}
