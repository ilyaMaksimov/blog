<?php

namespace App\Models\Category;


use App\Models\Post\Post;
use Illuminate\Support\Facades\Request;

class CategoryRepository
{
    public static function save( $request)
    {
        $post = new Category();
        $post->title = $request['title'];
        $post->save();
    }

    public static function update()
    {

    }
}