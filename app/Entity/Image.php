<?php

namespace App\Entity;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Image
{
    const SAVE_DIRECTORY = '/uploads/';
    const DEFAULT_IMAGE = '/img/no-image.png';

    private $name;

    public static function getPath($image)
    {
        if ($image == null) {
            return self::DEFAULT_IMAGE;
        }

        return self::SAVE_DIRECTORY . $image;
    }

    public function generateName($mimeType)
    {
        return str_random(10) . '.' . $mimeType;
    }

    public function getName()
    {
        return $this->name;
    }

    public function save($image)
    {
        if ($image == null) {
            $this->name = null;
        } else {
            /** @var UploadedFile $image */
            $this->name = $filename = $this->generateName($image->extension());
            $this->store($image, $filename);

        }
    }

    public function update($uploadImage, $currentImage)
    {
        if ($uploadImage == null) {
            $this->name = null;
        } else {
            $this->remove($currentImage);
            $this->save($uploadImage);
        }
    }

    public function remove(string $image)
    {
        if ($image != null) {
            Storage::delete('uploads/' . $image);
        }
    }


    private function store(UploadedFile $uploadedFile, string $filename)
    {
        $uploadedFile->storeAs(self::SAVE_DIRECTORY, $filename);
    }


}
