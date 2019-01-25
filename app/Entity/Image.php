<?php

namespace App\Entity;

use Illuminate\Http\Request;

class Image
{
    const SAVE_DIRECTORY = '/uploads/';
    const DEFAULT_IMAGE = '/img/no-image.png';

    public static function save(Request $requestImage): string
    {
        $filename = self::generateName($requestImage->extension());
        $requestImage->storeAs(self::SAVE_DIRECTORY, $filename);
        return $filename;
    }

    public static function getPath($image)
    {
        if ($image == null) {
            return self::DEFAULT_IMAGE;
        }

        return self::SAVE_DIRECTORY . $image;
    }

    public static function generateName($mimeType)
    {
        return str_random(10) . '.' . $mimeType;
    }
}