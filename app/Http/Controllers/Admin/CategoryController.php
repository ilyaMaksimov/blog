<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;

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
        $this->categoryRepository->add($request);
        return redirect()->route('category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->categoryRepository->update($request, $id);
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->route('category.index');
    }
}
