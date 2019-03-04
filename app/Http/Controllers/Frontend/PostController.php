<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    private $postRepository;
    private $categoryRepository;

    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $posts = $this->postRepository->paginateAll(2, $request['page'] ?? 1);
        return view('frontend.post.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = $this->postRepository->findOneBy(['slug' => $slug]);
        $relatedPosts = $this->postRepository->related($post);

        return view('frontend.post.show', compact('post', 'relatedPosts'));
    }


    public function tag($slug)
    {
        $posts = $this->postRepository->findBySlugTag($slug);
        return view('frontend.post.list', compact('posts'));
    }

    public function category($slug)
    {
        $posts = $this->postRepository->findBySlugCategory($slug);
        return view('frontend.post.list', compact('posts'));
    }
}
