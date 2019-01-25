<?php

namespace App\Models\Post;

use Illuminate\Http\Request;

class PostService
{
    public function store(Request $request)
    {
        PostRepository::add($request);
    }

    public function update(Request $request, int $id)
    {
        PostRepository::update($request, $id);
    }

    public function destroy(int $id)
    {
        PostRepository::delete($id);
    }
}