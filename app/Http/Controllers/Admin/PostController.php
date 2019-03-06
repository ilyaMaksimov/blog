<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostController
 * @package App\Http\Controllers\Admin
 *
 * @property PostRepository $postRepository
 * @property CategoryRepository $categoryRepository
 * @property TagRepository $tagRepository
 */
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
        $categories = $this->categoryRepository->selectIdAndTitle();
        $tags = $this->tagRepository->selectIdAndTitle();

        return view('admin.post.create', compact('categories', 'tags'));
    }

    public function store(StoreRequest $request)
    {
        //dd($request);
        try {
            $this->postRepository->add($request);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('post.index')->with('danger', 'Ошибка при добавлении поста');
        }
        return redirect()->route('post.index')->with('success', 'Пост успешно добавлен');
    }

    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        if (!$post) {
            throw new NotFoundHttpException('Такого поста не существует!');
        }
        $categories = $this->categoryRepository->selectIdAndTitle();
        $tags = $this->tagRepository->selectIdAndTitle();

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $this->postRepository->update($request, $id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('post.index')->with('danger', 'Ошибка при изменении поста');
        }

        return redirect()->route('post.index')->with('success', 'Пост успешно изменен');
    }

    public function destroy($id)
    {
        try {
            $this->postRepository->delete($id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('post.index')->with('danger', 'Ошибка при удалении поста');
        }

        return redirect()->route('post.index')->with('success', 'Пост успешно удален');
    }
}
