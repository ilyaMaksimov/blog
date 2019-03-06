<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 *
 * @property CategoryRepository $categoryRepository
 */
class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->findAll();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            $this->categoryRepository->add($request->toArray());
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('category.index')->with('danger', 'Ошибка при добавлении категории!');
        }

        return redirect()->route('category.index')->with('success', 'Категория успешно добавленна!');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            throw new NotFoundHttpException('Такой категории не существует!');
        }

        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $this->categoryRepository->update($request->toArray(), $id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('category.index')->with('danger', 'Ошибка при обновлении категории!');
        }

        return redirect()->route('category.index')->with('success', 'Категория успешно изменена!');
    }

    public function destroy($id)
    {
        try {
            $this->categoryRepository->delete($id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('category.index')->with('danger', 'Ошибка при удалении категории!');
        }

        return redirect()->route('category.index')->with('success', 'Категория успешно удалена!');
    }
}
