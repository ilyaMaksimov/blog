<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    private $postRepository;
    private $categoryRepository;
    private $tagRepository;

    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->findAll();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->getArrayOfIdAndTitle();
        $tags = $this->tagRepository->getArrayOfIdAndTitle();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    public function store(StoreRequest $request)
    {
        $this->postRepository->add($request);
        return redirect()->route('post.index');
    }

    public function show()
    {

    }

    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        $categories = $this->categoryRepository->getArrayOfIdAndTitle();
        $tags = $this->tagRepository->getArrayOfIdAndTitle();

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->postRepository->update($request, $id);
        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return redirect()->route('post.index');
    }
}
