<?php

namespace App\Models;

use Guzzle\Http\Message\Request;

class Image
{
    public static function save(Request $requestImage): string
    {
        $filename = str_random(10) . '.' . $requestImage->extension();
        $requestImage->storeAs('uploads', $filename);
        return $filename;
    }
}