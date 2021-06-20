<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

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
