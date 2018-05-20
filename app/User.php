<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\Traits\IsPhotogenic;
use App\Traits\User\FormatsDates;

class User extends Authenticatable
{
    use Notifiable,
        IsPhotogenic,
        FormatsDates;

    const MIN_PASSWORD_LENGTH = 8;

    protected $defaultImageFile          = "cartoon_user_fullsize.png";
    protected $defaultThumbnailImageFile = "cartoon_user_thumbnail.png";
    protected $defaultIconImageFile      = "cartoon_user_icon.png";

    static public function getValidations($userId = null)
    {
        $timezones = implode(',', array_keys(config("piglet.timezones")));

        $email  = 'required|email|unique:users,email';
        $email .= ($userId) ? ",$userId" : '';

        return [
            'firstName' => 'required|max:255',
            'lastName'  => 'required|max:255',
            'timezone'  => 'required|in:' . $timezones,
            'email'     => $email,
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'timezone', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function families()
    {
        return $this->belongsToMany('App\Family')->using('App\FamilyUser');
    }







    /**
     * @param string $size
     * @return string
     */
    protected function getImageRoute($size = 'full')
    {
        return route('user.photo', ['user' => $this, 'size' => $size, 'imageFile' => $this->image]);
    }

    /**
     * @return string
     */
    protected function photoDirectory()
    {
        $directory = 'user/' . $this->id . '/profile_photos';

        Storage::disk('local')->exists($directory) || Storage::disk('local')->makeDirectory($directory);

        return $directory;
    }

    /**
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected function storageDisk()
    {
        return Storage::disk('local');
    }


}
