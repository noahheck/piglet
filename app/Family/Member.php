<?php

namespace App\Family;

use App\Traits\HasBirthdate;
use App\Traits\IsPhotogenic;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    use HasBirthdate,
        IsPhotogenic;



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
    ];

    public static function getValidations()
    {
        return [
            'firstName'  => 'required|max:255',
            'middleName' => 'max:255',
            'lastName'   => 'max:255',
            'suffix'     => 'max:255',
            'birthdate'  => 'date|nullable',
            'gender'     => 'in:male,female|nullable',
            'color'      => 'max:20',
        ];
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'birthdate',
    ];



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
