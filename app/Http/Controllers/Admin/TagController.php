<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Tag\Tag;
use App\Http\Controllers\Controller;
use App\Models\Tag\TagRepository;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(StoreRequest $request)
    {
        TagRepository::save($request);
        return redirect()->route('tag.index');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(UpdateRequest $request, $id)
    {
        TagRepository::update($request, $id);
        return redirect()->route('tag.index');
    }

    public function destroy($id)
    {
        TagRepository::delete($id);
        return redirect()->route('tag.index');
    }
}
