<?php

namespace App\Components;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Class Image
 * @package App\Components
 *
 * @property string $name
 * @property UploadedFile $image
 */
class Image
{
    const SAVE_DIRECTORY = 'uploads/';
    const DEFAULT_IMAGE = '/img/no-image.png';

    private $image;
    private $name;

    public function __construct($image)
    {
        $this->image = $image;
        if (!is_null($this->image)) {
            $this->name = $this->generateName($this->image->extension());
        }
    }

    public static function getPath($image)
    {
        if (is_null($image)) {
            return self::DEFAULT_IMAGE;
        }

        return '/' . self::SAVE_DIRECTORY . $image;
    }

    public static function remove(string $nameImage)
    {
        if (!is_null($nameImage)) {
            Storage::delete(self::SAVE_DIRECTORY . $nameImage);
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function compressionToStandardSize()
    {
        if (!is_null($this->name)) {
            \Intervention\Image\Facades\Image::make(public_path('/' . self::SAVE_DIRECTORY . $this->name))
                ->fit(config('image.post.width'), config('image.post.height'))
                ->save(self::SAVE_DIRECTORY . $this->name);
        }
    }

    public function saveToDirectory()
    {
        if (!is_null($this->name)) {
            $this->image->storeAs('/' . self::SAVE_DIRECTORY, $this->name);
        }
    }

    public function update($currentImage)
    {
        if (!is_null($this->name)) {
            self::remove($currentImage);
            $this->saveToDirectory();
        }
    }

    private function generateName($mimeType)
    {
        return str_random(10) . '.' . $mimeType;
    }



}
