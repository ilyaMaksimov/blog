<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Category\CategoryRepository;
use App\Models\Post\Post;
use App\Models\Post\PostRepository;
use App\Http\Controllers\Controller;
use App\Models\Tag\TagRepository;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = CategoryRepository::getArrayOfIdAndTitle();
        $tags = TagRepository::getArrayOfIdAndTitle();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    public function store(StoreRequest $request)
    {
        PostRepository::add($request);
        return redirect()->route('post.index');
    }

    public function show()
    {

    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = CategoryRepository::getArrayOfIdAndTitle();
        $tags = TagRepository::getArrayOfIdAndTitle();

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdateRequest $request, $id)
    {
        PostRepository::update($request, $id);
        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        PostRepository::delete($id);
        return redirect()->route('post.index');
    }
}
