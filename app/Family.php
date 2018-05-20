<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use App\Traits\IsPhotogenic;

class Family extends Model
{
    use IsPhotogenic;

    protected $defaultImageFile          = "cartoon_family_fullsize.jpg";
    protected $defaultThumbnailImageFile = "cartoon_family_thumbnail.jpg";
    protected $defaultIconImageFile      = "cartoon_family_icon.jpg";

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
            'familyPhoto' => 'image',
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
     * @param string $size
     * @return string
     */
    protected function getImageRoute($size = 'full')
    {
        return route('family.photo', ['family' => $this, 'size' => $size, 'imageFile' => $this->image]);
    }

    /**
     * @return string
     */
    protected function photoDirectory()
    {
        return $this->familyStorageDirectory() . '/family_photos';
    }

    /**
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected function storageDisk()
    {
        return Storage::disk('family');
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
    public static function createNew($fillables, $user, $familyPhoto = null, $photoUploaderService, $connectService)
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
        $disk = $family->storageDisk();

        $disk->makeDirectory($family->familyStorageDirectory());

        $familyPhotosDirectory = $family->photoDirectory();
        $disk->makeDirectory($familyPhotosDirectory);

        $disk->put($family->familyStorageDirectory() . '/db.sqlite', '');

        $connectService->connectToFamily($family)->migrate();



        // Save the uploaded family photo if provided
        if ($familyPhoto) {
            $family->uploadPhoto($familyPhoto, $photoUploaderService);
        }


        return $family;
    }










    private function familyStorageDirectory()
    {
        return $this->id;
    }


}
