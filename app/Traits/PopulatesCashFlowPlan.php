<?php

namespace App\Traits;

trait PopulatesCashFlowPlan
{
    public static $typeDescriptions = [
        'budget' => 'Budgeted',
        'actual' => 'Actual',
    ];

    public function typeDescription()
    {
        return self::$typeDescriptions[$this->type];
    }
}
