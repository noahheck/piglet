<?php

namespace App;

use App\Family\Member;
use App\Interfaces\Definitions\Settings;
use App\Service\FamilyConnectService;
use App\Service\PhotoUploaderService;
use App\Traits\Family\StoresSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use App\Traits\IsPhotogenic;

class Family extends Model implements Settings
{
    use IsPhotogenic,
        StoresSettings
        ;

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
            ->using('App\FamilyUser');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }







    public function photoAltText()
    {
        return $this->name;
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
        return $this->storagePath() . '/db.sqlite';
    }


    public function storagePath()
    {
        return storage_path('piglet/' . $this->familyStorageDirectory());
    }



    /**
     * Process for creating a new Family - creates the storage directory and database (eventually)
     *
     * @param array $fillables
     * @param \App\User $user
     * @param \Illuminate\Http\UploadedFile $familyPhoto
     * @param PhotoUploaderService $photoUploaderService
     * @param FamilyConnectService $connectService
     *
     * @return Family
     */
    public static function createNew(
        $fillables,
        $user,
        $familyPhoto = null,
        $photoUploaderService,
        FamilyConnectService $connectService
    ) {
        $family = new Family;

        $family->fill($fillables);
        $family->creator = $user->id;
        $family->save();

        $user->families()->attach($family);

        // Create storage directory for this new family
        $disk = $family->storageDisk();

        $disk->makeDirectory($family->familyStorageDirectory());

        $familyPhotosDirectory = $family->photoDirectory();
        $disk->makeDirectory($familyPhotosDirectory);

        // Save the uploaded family photo if provided
        if ($familyPhoto) {
            $family->uploadPhoto($familyPhoto, $photoUploaderService);
        }

        $disk->put($family->familyStorageDirectory() . '/db.sqlite', '');

        $connectService->connectToFamily($family)->migrate();

        // Create a family member entry for the user who created the family
        $member = new Member;
        $member->family           = $family->id;
        $member->user_id          = $user->id;
        $member->firstName        = $user->firstName;
        $member->lastName         = $user->lastName;
        $member->allow_login      = true;
        $member->is_administrator = true;
        $member->login_email      = $user->email;
        $member->color            = Member::COLOR_DEFAULT;

        $member->save();

        return $family;
    }










    private function familyStorageDirectory()
    {
        return $this->id;
    }


}
