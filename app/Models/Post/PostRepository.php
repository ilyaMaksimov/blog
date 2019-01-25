<?php

namespace App\Models\Post;

use App\Entity\Image;
use Illuminate\Http\Request;

class PostRepository
{
    public static function add(Request $request)
    {
        $image = new Image();
        $image->save($request->file('image'));

        $post = new Post();
        $post->fill($request->except('tags'));
        $post->image = $image->getName();
        $post->save();

        $post->tags()->sync($request->tags);
    }

    public static function update(Request $request, int $id)
    {
        $post = Post::findOrFail($id);

        $image = new Image();
        $image->update($request->file('image'), $post->image);

        $post->image = $image->getName();
        $post->update($request->except(['tags', 'image']));
        $post->tags()->sync($request->tags);
    }

    public static function delete(int $id)
    {
        $post = Post::findOrFail($id);
        (new Image())->remove($post->image);
        $post->delete();
    }
}