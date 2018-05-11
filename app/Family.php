<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'details',
    ];

    public static function getValidations()
    {
        return [
            'name' => 'required|max:255',
        ];
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->using('App\FamilyUser');
    }



    /**
     * Returns whether the provided user has been granted access to this family
     *
     * @return bool
     */
    public function isAccessibleBy(User $user)
    {
        return $this->users->contains($user);
    }
}
