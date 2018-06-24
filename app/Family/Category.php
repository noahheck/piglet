<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes

        ;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public static function getValidations()
    {
        return [
            'name' => 'required',
        ];
    }



    public function merchants()
    {
        return $this->hasMany(Merchant::class, 'default_category_id');
    }
}
