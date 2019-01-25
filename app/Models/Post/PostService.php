<?php

namespace App\Models\Post;

use App\Entity\Image;
use Illuminate\Http\Request;

class PostService
{
    public function store(Request $request)
    {
        /** @var Post $post */
        $post = Post::create($request->except('tags'));
        $post->tags()->sync($request->tags);
    }

    public function update(Request $request, int $id)
    {
        /** @var Post $post */
        $post = Post::findOrFail($id);
        $post->image = Image::save($request->file('image'));
        $post->update($request->except(['tags', 'image']));
        $post->tags()->sync($request->tags);
    }

    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }

}