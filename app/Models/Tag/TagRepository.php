<?php

namespace App\Models\Tag;

class TagRepository
{
    public static function save($request)
    {
        $tag = new Tag();
        $tag->title = $request['title'];
        $tag->save();
    }

    public static function update($request, int $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->title = $request['title'];
        $tag->update();
    }

    public static function delete(int $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
    }

    public static function getArrayOfIdAndTitle()
    {
        return Tag::select('title', 'id')->pluck('title', 'id');
    }
}
