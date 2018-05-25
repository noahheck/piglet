<?php

namespace App\Traits;

use App\Service\PhotoUploaderService;

trait IsPhotogenic
{

    /**
     *
     * Models should have a string:image and datetime:image_updated_at db property
     *
     *
     *
     * Define 3 properties for the default image if the entity doesn't have one yet(1 for each size) - These files
     * need to be in the public/img directory
     *
     * protected $defaultThumbnailImageFile
     *
     * protected $defaultIconImageFile
     *
     * protected $defaultImageFile
     *
     *
     *
     * Also, define a `getImageRoute` function that uses the `route` function to generate the route to the image for the
     * entity
     *
     * protected function getImageRoute($size = 'full')
     *
     *
     *
     * Then, we need a `photoDirectory` function that returns the directory where the entity photos are stored
     *
     * protected function photoDirectory()
     *
     *
     *
     * Finally, to update the photo, define a `storageDisk` function to return the e.g. `Storage::disk('family')` call
     *
     * protected function storageDisk()
     */


    /**
     *
     */
    public function icon(array $withClasses = [])
    {
        $classes = implode(' ', $withClasses);
        return "<img class='{$classes}' src='{$this->imagePath('icon') }' alt='{$this->photoAltText()}'>";
    }

    public function thumbnail(array $withClasses = [])
    {
        $classes = implode(' ', $withClasses);
        return "<img class='{$classes}' src='{$this->imagePath('thumbnail') }' alt='{$this->photoAltText()}'>";
    }

    public function photo(array $withClasses = [])
    {
        $classes = implode(' ', $withClasses);
        return "<img class='{$classes}' src='{$this->imagePath('full') }' alt='{$this->photoAltText()}'>";
    }

    public function photoAltText()
    {
        return "Photo";
    }


    /**
     * @param string $size
     * @return string
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

            \DebugBar::info(asset('/img/' . $this->$prop));

            return asset('/img/' . $this->$prop);
        }

        return $this->getImageRoute($size);
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

        return $this->photoDirectory() . '/' . $photoFile;
    }

    /**
     * @param $familyPhoto
     * @param PhotoUploaderService $photoUploaderService
     * @return $this
     */
    public function uploadPhoto($photo, PhotoUploaderService $photoUploaderService)
    {
        $photoNum = 1;

        if ($this->image) {
            list($curNum, $ext) = explode('.', $this->image);
            $photoNum = $curNum + 1;
        }

        $disk = $this->storageDisk();

        $uploaded = $photoUploaderService->uploadFile($photo, $disk, $this->photoDirectory(), $photoNum);

        $photoName = $uploaded['photoName'];

        $this->image            = $photoName;
        $this->image_updated_at = new \DateTime();

        $this->save();

        return $this;
    }
}
