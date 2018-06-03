<?php

namespace App\Family;

use App\Family\Task;

use App\Traits\HasBirthdate;
use App\Traits\IsPhotogenic;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    use HasBirthdate;

    use IsPhotogenic {
        icon as protected photogenicIcon;
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'suffix',
        'birthdate',
        'gender',
        'color',
        'login_email',
    ];

    public static function getValidations()
    {
        return [
            'firstName'   => 'required|max:255',
            'middleName'  => 'max:255',
            'lastName'    => 'max:255',
            'suffix'      => 'max:255',
            'birthdate'   => 'date|nullable',
            'gender'      => 'in:male,female|nullable',
            'color'       => 'max:20',
            'login_email' => 'email|nullable',
        ];
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'birthdate',
    ];

    protected $casts = [
        'allow_login' => 'boolean',
    ];



    public function tasks()
    {
        return $this->hasMany(Task::class);
    }



    public function getInitialsAttribute()
    {
        return substr($this->firstName, 0, 1) . substr($this->lastName, 0, 1);
    }

    public function icon(array $withClasses = [])
    {
        if ($this->image) {
            return $this->photogenicIcon($withClasses);
        }

        return "<span class='rounded-circle' style='color: #fff; padding: 7px; background-color: {$this->color};' title='{$this->photoAltText()}'>{$this->initials}</span>";
    }

    public function photoAltText()
    {
        return $this->firstName . ' ' . $this->lastName;
    }



    protected $defaultImageFile          = "cartoon_user_fullsize.png";
    protected $defaultThumbnailImageFile = "cartoon_user_thumbnail.png";
    protected $defaultIconImageFile      = "cartoon_user_icon.png";

    /**
     * @param string $size
     * @return string
     */
    protected function getImageRoute($size = 'full')
    {
        return route('family.member.photo', [
            'family'    => $this->family,
            'member'    => $this,
            'size'      => $size,
            'imageFile' => $this->image,
        ]);
    }

    /**
     * @return string
     */
    protected function photoDirectory()
    {
        $photoDirectory = $this->familyStorageDirectory() . '/members/' . $this->id;

        $disk = $this->storageDisk();

        $disk->exists($photoDirectory) || $disk->makeDirectory($photoDirectory);

        return $photoDirectory;
    }

    /**
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected function storageDisk()
    {
        return Storage::disk('family');
    }




    private function familyStorageDirectory()
    {
        return $this->family;
    }
}
