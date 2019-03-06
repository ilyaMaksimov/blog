<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TagController
 * @package App\Http\Controllers\Admin
 *
 * @property TagRepository $tagRepository
 */
class TagController extends Controller
{

    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->findAll();
        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            $this->tagRepository->add($request->toArray());
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('tag.index')->with('danger', 'Ошибка при добавлении тега!');
        }

        return redirect()->route('tag.index')->with('success', 'Тег успешно добавлен!');
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->find($id);
        if (!$tag) {
            throw new NotFoundHttpException('Такого тега не существует!');
        }
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $this->tagRepository->update($request->toArray(), $id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('tag.index')->with('danger', 'Ошибка при обновлении тега!');
        }

        return redirect()->route('tag.index')->with('success', 'Тег успешно изменен!');
    }

    public function destroy($id)
    {
        try {
            $this->tagRepository->delete($id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('tag.index')->with('danger', 'Ошибка при удалении тега!');
        }

        return redirect()->route('tag.index')->with('success', 'Тег успешно удален!');
    }
}
