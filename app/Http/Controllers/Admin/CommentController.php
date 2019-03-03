<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;
use App\Repositories\TagRepository;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $comments = $this->commentRepository->findAll();
        return view('admin.comment.index', compact('comments'));
    }

    public function toggle($id)
    {
        $this->commentRepository->toggleStatus($id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->commentRepository->delete($id);
        return redirect()->back();
    }
}
