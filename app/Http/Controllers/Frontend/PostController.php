<?php

namespace App\Http\Controllers\Frontend;

use App\Entities\Post;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class PostController
 * @package App\Http\Controllers\Frontend
 *
 * @property PostRepository $postRepository
 * @property CategoryRepository $categoryRepository
 */
class PostController extends Controller
{
    private $postRepository;
    private $categoryRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $posts = $this->postRepository->getPublicPostWithPagination(2, $request['page'] ?? 1);
        return view('frontend.post.index', compact('posts'));
    }

    public function show($slug)
    {
        /** @var Post $post */
        $post = $this->postRepository->findOneBy(['slug' => $slug]);
        if (!$post) {
            throw new NotFoundHttpException('Такого поста не существует!');
        }

        $relatedPosts = $this->postRepository->related($post);

        return view('frontend.post.show', compact('post', 'relatedPosts'));
    }


    public function tag($slug)
    {
        $posts = $this->postRepository->findBySlugTagWithPagination($slug, 2, $request['page'] ?? 1);

        if ($posts->isEmpty()) {
            throw new NotFoundHttpException('Такого тега не существует!');
        }

        return view('frontend.post.list', compact('posts'));
    }


    public function category(Request $request, $slug)
    {
        $posts = $this->postRepository->findBySlugCategoryWithPagination($slug, 2, $request['page'] ?? 1);

        if ($posts->isEmpty()) {
            throw new NotFoundHttpException('Такой категории не существует!');
        }

        return view('frontend.post.list', compact('posts'));
    }
}
