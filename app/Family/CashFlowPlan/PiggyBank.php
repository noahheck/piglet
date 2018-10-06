<?php

namespace App\Family\CashFlowPlan;

use App\Family\CashFlowPlan;
use App\Family\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PiggyBank extends Model
{
    use SoftDeletes;

    protected $table = 'cash_flow_plan_piggy_banks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'piggy_bank_id',
        'projected',
        'detail',
    ];

    public static function getValidations()
    {
        return [
            'piggy_bank_id' => 'integer',
            'projected'     => 'numeric|nullable',
        ];
    }



    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }

    public function piggyBank()
    {
        return $this->belongsto(\App\Family\PiggyBank::class);
    }

    public function contributions()
    {
        return $this->hasMany(PiggyBankContribution::class);
    }



    public function actualTotal()
    {
        return $this->contributions->sum('actual');
    }

    public function contributionsTargetAchieved()
    {
        return $this->actualTotal() >= $this->projected;
    }

    public function percentAchieved()
    {
        if (!$this->projected) {
            return null;
        }

        return ($this->actualTotal() / $this->projected) * 100;
    }
}
