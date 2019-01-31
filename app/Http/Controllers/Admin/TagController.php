<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;

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
        $this->tagRepository->add($request);
        return redirect()->route('tag.index');
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->find($id);
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->tagRepository->update($request, $id);
        return redirect()->route('tag.index');
    }

    public function destroy($id)
    {
        $this->tagRepository->delete($id);
        return redirect()->route('tag.index');
    }
}
