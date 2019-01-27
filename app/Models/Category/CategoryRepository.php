<?php

namespace App\Models\Category;

class CategoryRepository
{
    public static function save($request)
    {
        $category = new Category();
        $category->title = $request['title'];
        $category->save();
    }

    public static function update($request, $id)
    {
        $category = Category::findOrFail($id);
        $category->title = $request['title'];
        $category->update();
    }

    public static function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }

    public static function getArrayOfIdAndTitle()
    {
        return Category::select('title', 'id')->pluck('title', 'id');
    }
}
