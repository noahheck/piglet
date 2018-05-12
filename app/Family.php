<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Family extends Model
{
    protected $defaultImageFile = "/img/cartoon_family.jpg";

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
     *
     */
    public function imagePath()
    {
        if (!$this->image) {
            return asset($this->defaultImageFile);
        }
        return route('family.photo', $this);
    }


    public function imageFile()
    {
        return $this->familyPhotosDirectory() . '/' . $this->image;
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



    /**
     * Process for creating a new Family - creates the storage directory and database (eventually)
     *
     * @param array $fillables
     * @param \App\User $user
     * @param \Illuminate\Http\UploadedFile $familyPhoto
     *
     * @return Family
     */
    public static function createNew($fillables, $user, $familyPhoto = null)
    {
        $family = new Family;

        $family->fill($fillables);
        $family->creator = $user->id;
        $family->save();

        $familyUser                  = new FamilyUser;
        $familyUser->family_id       = $family->id;
        $familyUser->user_id         = $user->id;
        $familyUser->active          = true;
        $familyUser->isAdministrator = true;
        $familyUser->save();

        // Create storage directory for this new family
        $disk = Storage::disk('family');
        $disk->makeDirectory($family->id);

        $familyPhotosDirectory = $family->familyPhotosDirectory();
        $disk->makeDirectory($familyPhotosDirectory);

        // Save the uploaded family photo if provided
        if ($familyPhoto) {
            $familyPhotoFilename = '1.' . $familyPhoto->guessExtension();
            $disk->putFileAs($familyPhotosDirectory, $familyPhoto, $familyPhotoFilename);

            $family->image            = $familyPhotoFilename;
            $family->image_updated_at = new \DateTime();

            $family->save();
        }

        return $family;
    }

    /**
     * @return string
     */
    public function updateFamilyPhoto($familyPhoto)
    {
        $photoNum = 1;

        if ($this->image) {
            list($curNum, $ext) = explode('.', $this->image);
            $photoNum = $curNum + 1;
        }

        $familyPhotoName = $photoNum . '.' . $familyPhoto->guessExtension();

        Storage::disk('family')->putFileAs($this->familyPhotosDirectory(), $familyPhoto, $familyPhotoName);

        $this->image            = $familyPhotoName;
        $this->image_updated_at = new \DateTime();

        $this->save();

        return $this;
    }

    private function familyPhotosDirectory()
    {
        return $this->id . '/family_photos';
    }
}
