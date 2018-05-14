<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class User extends Authenticatable
{
    use Notifiable;

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
    public function imageFile($size)
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


    public function updateProfilePhoto($profilePhoto)
    {
        $photoNum = 1;

        if ($this->image) {
            list($curNum, $ext) = explode('.', $this->image);
            $photoNum = $curNum + 1;
        }

        $ext = $profilePhoto->guessExtension();

        $profilePhotoName = $photoNum . '.'           . $ext;
        $thumbPhotoName   = $photoNum . '.thumbnail.' . $ext;
        $iconPhotoName    = $photoNum . '.icon.'      . $ext;


        // Need to make 2 sizes - Thumbnail ~ 200 x 200 | Icon ~ 50 x 50

        $baseImage = Image::make($profilePhoto);
        $baseWidth = $baseImage->width();
        $baseHeight = $baseImage->height();

        $thumbWidth = 200;
        $iconWidth  = 50;

        $thumbHeight = null;
        $iconHeight  = null;

        if ($baseHeight > $baseWidth) {
            $thumbWidth = null;
            $iconWidth  = null;

            $thumbHeight = 200;
            $iconHeight  = 50;
        }

        $thumbImage = Image::make($profilePhoto);
        $thumbImage->resize($thumbWidth, $thumbHeight, function($constraint) {
            $constraint->aspectRatio();
        });

        $iconImage = Image::make($profilePhoto);
        $iconImage->resize($iconWidth, $iconHeight, function($constraint) {
            $constraint->aspectRatio();
        });

        $disk = Storage::disk('local');

        $disk->putFileAs($this->userPhotoDirectory(), $profilePhoto, $profilePhotoName);
        $disk->put($this->userPhotoDirectory() . '/' . $thumbPhotoName, (string) $thumbImage->encode());
        $disk->put($this->userPhotoDirectory() . '/' . $iconPhotoName, (string) $iconImage->encode());



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
