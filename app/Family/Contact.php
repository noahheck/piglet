<?php

namespace App\Family;

use App\Traits\HasAddress;
use App\Traits\HasBirthdate;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes,
        HasBirthdate,
        HasAddress;

    public function getNameAttribute()
    {
        $names = collect([$this->first_name, $this->last_name]);

        return $names->filter()->implode(' ');
    }

    public function getFullnameAttribute()
    {
        $names = collect([$this->first_name, $this->middle_name, $this->last_name]);

        return $names->filter()->implode(' ');
    }
}
