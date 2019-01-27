<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category\Category;
use App\Models\Category\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {

        return view('admin.category.create');
    }

    public function store(StoreRequest $request)
    {
        CategoryRepository::save($request);
        return redirect()->route('category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateRequest $request, $id)
    {
        CategoryRepository::update($request, $id);
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        CategoryRepository::delete($id);
        return redirect()->route('category.index');
    }
}
