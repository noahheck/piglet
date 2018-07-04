<?php

namespace App\Family;

use App\Traits\HasAddress;
use App\Traits\HasPhoneNumber;
use App\Traits\HasSecondaryPhoneNumber;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use SoftDeletes,
        HasPhoneNumber,
        HasSecondaryPhoneNumber,
        HasAddress
    {
        HasPhoneNumber::formatForDatabase insteadof HasSecondaryPhoneNumber;
        HasPhoneNumber::formatForOutput insteadof HasSecondaryPhoneNumber;
    }

    protected $fillable = [
        'name',
        'default_category_id',
        'default_sub_category',
        'details',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'phone',
        'secondaryPhone',
        'url',
    ];

    public static function getValidations()
    {
        return [
            'name'                => 'required',
            'url'                 => 'url|nullable',
            'default_category_id' => 'integer|nullable',
        ];
    }



    public function defaultCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function recurringExpenses()
    {
        return $this->hasMany(RecurringExpense::class);
    }
}
