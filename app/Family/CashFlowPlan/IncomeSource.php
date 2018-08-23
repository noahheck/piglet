<?php

namespace App\Family\CashFlowPlan;

use App\Family\CashFlowPlan;
use App\Family\Model;
use App\Traits\HasDateField;
use App\Traits\PopulatesCashFlowPlan;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeSource extends Model
{
    use SoftDeletes,
        HasDateField,
        PopulatesCashFlowPlan;

    protected $table = 'cash_flow_plan_income_sources';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'income_source_id',
        'name',
        'projected',
        'actual',
        'date',
        'detail',
    ];

    public static function getValidations()
    {
        return [
            'name'             => 'required',
            'income_source_id' => 'integer|nullable',
            'projected'        => 'numeric|nullable',
            'actual'           => 'numeric|nullable',
            'date'             => 'date|nullable',
        ];
    }

    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }

    public function incomeSourceTemplate()
    {
        return $this->belongsTo(\App\Family\IncomeSource::class);
    }
}
