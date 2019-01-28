<?php

namespace App\Models\Post;

use App\Entity\Image;
use Illuminate\Http\Request;

class PostRepository
{
    public static function add( $request)
    {
        $image = new Image();
        $image->save($request['image']);

        $post = new Post();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->status = $post->isPublic($request['status']);
        $post->is_featured = $post->isFeatured($request['is_featured']);
        $post->date = $request['date'];
        $post->image = $image->getName();
        $post->save();

        $post->tags()->sync($request['tags']);
    }

    public static function update(Request $request, int $id)
    {
        /** @var Post $post */
        $post = Post::findOrFail($id);

        $image = new Image();

        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->status = $post->isPublic($request['status']);
        $post->is_featured = $post->isFeatured($request['is_featured']);
        $post->date = $request['date'];

        $image->update($request['image'], $post->image);
        $post->image = $image->getName();
        $post->save();

        $post->tags()->sync($request['tags']);
    }

    public static function delete(int $id)
    {
        $image = new Image();

        $post = Post::findOrFail($id);
        $image->remove($post->image);
        $post->delete();
    }
}