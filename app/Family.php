<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Family extends Model
{
    protected $defaultImageFile          = "/img/cartoon_family_fullsize.jpg";
    protected $defaultThumbnailImageFile = "/img/cartoon_family_thumbnail.jpg";
    protected $defaultIconImageFile      = "/img/cartoon_family_icon.jpg";

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
        return $this->belongsToMany('App\User')
            ->withPivot(FamilyUser::PIVOT_ATTRIBUTES)
            ->using('App\FamilyUser');
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
        return route('family.photo', ['family' => $this, 'size' => $size, 'imageFile' => $this->image]);
    }

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

        return $this->familyPhotosDirectory() . '/' . $photoFile;
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
     * Returns FamilyUser instance for the provided user
     *
     * @return FamilyUser
     */
    public function familyUser(User $user)
    {
        return $this->users()->where('user_id', $user->id)->first()->pivot;
    }



    /**
     * Returns the path to the database storage file for the family
     *
     * @return string
     */
    public function dbFilePath()
    {
        return storage_path('piglet/'. $this->familyStorageDirectory() . '/db.sqlite');
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
    public static function createNew($fillables, $user, $familyPhoto = null, $photoUploaderService)
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
        $disk->makeDirectory($family->familyStorageDirectory());

        $familyPhotosDirectory = $family->familyPhotosDirectory();
        $disk->makeDirectory($familyPhotosDirectory);

        $disk->put($family->familyStorageDirectory() . '/db.sqlite', '');

        // Save the uploaded family photo if provided
        if ($familyPhoto) {
            $family->updateFamilyPhoto($familyPhoto, $photoUploaderService);
        }

        return $family;
    }

    /**
     * @return string
     */
    public function updateFamilyPhoto($familyPhoto, $photoUploaderService)
    {
        $photoNum = 1;

        if ($this->image) {
            list($curNum, $ext) = explode('.', $this->image);
            $photoNum = $curNum + 1;
        }

        $disk = Storage::disk('family');

        $uploaded = $photoUploaderService->uploadFile($familyPhoto, $disk, $this->familyPhotosDirectory(), $photoNum);

        $familyPhotoName = $uploaded['photoName'];

        $this->image            = $familyPhotoName;
        $this->image_updated_at = new \DateTime();

        $this->save();

        return $this;
    }

    private function familyStorageDirectory()
    {
        return $this->id;
    }

    private function familyPhotosDirectory()
    {
        return $this->familyStorageDirectory() . '/family_photos';
    }
}
