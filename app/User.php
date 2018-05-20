<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\Traits\User\FormatsDates;

class User extends Authenticatable
{
    use Notifiable,
        FormatsDates;

    const MIN_PASSWORD_LENGTH = 8;

    protected $defaultImageFile          = "/img/cartoon_user_fullsize.png";
    protected $defaultThumbnailImageFile = "/img/cartoon_user_thumbnail.png";
    protected $defaultIconImageFile      = "/img/cartoon_user_icon.png";

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
     *
     */
    public function imagePath($size = 'full')
    {
        if (!$this->image) {

            switch ($size):

                case 'thumbnail':
                    $prop = 'defaultThumbnailImageFile';
                    break;

                case 'icon':
                    $prop = 'defaultIconImageFile';
                    break;

                default:
                    $prop = 'defaultImageFile';

            endswitch;

            return asset($this->$prop);
        }

        return route('user.photo', ['user' => $this, 'size' => $size, 'imageFile' => $this->image]);
    }

    /**
     * @param $size
     * @return string
     */
    public function imageFile($size = 'full')
    {
        list($photoNum, $ext) = explode('.', $this->image);

        $photoFile = $this->image;

        if ($size === 'thumbnail') {
            $photoFile = $photoNum . '.thumbnail.' . $ext;
        }

        if ($size === 'icon') {
            $photoFile = $photoNum . '.icon.' . $ext;
        }

        return $this->userPhotoDirectory() . '/' . $photoFile;
    }


    public function updateProfilePhoto($photoUploaderService, $profilePhoto)
    {
        $photoNum = 1;

        if ($this->image) {
            list($curNum, $ext) = explode('.', $this->image);
            $photoNum = $curNum + 1;
        }

        $disk = Storage::disk('local');


        $uploaded = $photoUploaderService->uploadFile($profilePhoto, $disk, $this->userPhotoDirectory(), $photoNum);

        $profilePhotoName = $uploaded['photoName'];

        $this->image            = $profilePhotoName;
        $this->image_updated_at = new \DateTime();

        $this->save();

        return $this;
    }

    private function userPhotoDirectory()
    {
        $directory = 'user/' . $this->id . '/profile_photos';

        Storage::disk('local')->exists($directory) || Storage::disk('local')->makeDirectory($directory);

        return $directory;
    }
}
