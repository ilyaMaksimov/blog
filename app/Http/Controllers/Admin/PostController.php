<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\Post\PostService;
use App\Models\Tag\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    /** @var PostService  service */
    private $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    public function store(StoreRequest $request)
    {
        $this->service->store($request);
        return redirect()->route('post.index');
    }

    public function show()
    {

    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->service->update($request, $id);
        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('post.index');
    }
}
