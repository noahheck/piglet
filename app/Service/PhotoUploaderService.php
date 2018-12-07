<?php

namespace App\Service;

use Intervention\Image\Facades\Image;

class PhotoUploaderService
{
    public function uploadFile($file, $disk, $directory, $basePhotoName)
    {
        $extension = $file->guessExtension();

        $photoName      = $basePhotoName . '.'           . $extension;
        $thumbPhotoName = $basePhotoName . '.thumbnail.' . $extension;
        $iconPhotoName  = $basePhotoName . '.icon.'      . $extension;

        $baseImage       = Image::make($file)->orientate();
        $baseImageWidth  = $baseImage->width();
        $baseImageHeight = $baseImage->height();

        $baseWidth  = 500;
        $thumbWidth = 200;
        $iconWidth  = 50;

        $baseHeight  = null;
        $thumbHeight = null;
        $iconHeight  = null;

        if ($baseImageHeight > $baseImageWidth) {
            $baseWidth  = null;
            $thumbWidth = null;
            $iconWidth  = null;

            $baseHeight  = 500;
            $thumbHeight = 200;
            $iconHeight  = 50;
        }

        $baseImage->resize($baseWidth, $baseHeight, function($constraint) {
            $constraint->aspectRatio();
        });

        $thumbImage = Image::make($file)->orientate();
        $thumbImage->resize($thumbWidth, $thumbHeight, function($constraint) {
            $constraint->aspectRatio();
        });

        $iconImage = Image::make($file)->orientate();
        $iconImage->resize($iconWidth, $iconHeight, function($constraint) {
            $constraint->aspectRatio();
        });

        $disk->put($directory . "/{$photoName}"     , (string) $baseImage->encode());
        $disk->put($directory . "/{$thumbPhotoName}", (string) $thumbImage->encode());
        $disk->put($directory . "/{$iconPhotoName}" , (string) $iconImage->encode());

        return [
            'success'        => true,
            'photoName'      => $photoName,
            'thumbPhotoName' => $thumbPhotoName,
            'iconPhotoName'  => $iconPhotoName,
        ];
    }
}
