<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FamilyUser extends Pivot
{
    const PIVOT_ATTRIBUTES = [
        'active',
        'isAdministrator',
    ];
}
