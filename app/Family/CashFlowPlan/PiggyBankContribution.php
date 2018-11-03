<?php

namespace App\Family\CashFlowPlan;

use App\Family\CashFlowPlan;
use App\Family\Model;
use App\Traits\HasDateField;
use Illuminate\Database\Eloquent\SoftDeletes;

class PiggyBankContribution extends Model
{
    use SoftDeletes,
        HasDateField
        ;

    protected $table = 'cash_flow_plan_piggy_bank_contributions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date',
    ];

    protected $fillable = [
        'piggy_bank_id',
        'actual',
        'date',
        'detail',
    ];

    public static function getValidations()
    {
        return [
            'piggy_bank_id' => 'required|integer',
            'actual'        => 'numeric|nullable',
            'date'          => 'date|nullable',
        ];
    }

    public function piggyBank()
    {
        return $this->belongsTo(PiggyBank::class);
    }

    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }

    public function title()
    {
        $title = $this->piggyBank->name;

        if ($this->date) {
            $title .= ' (' . \App\formatDate($this->date) . ')';
        }

        return $title;
    }
}
