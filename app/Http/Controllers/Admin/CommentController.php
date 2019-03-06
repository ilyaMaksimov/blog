<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;

/**
 * Class CommentController
 * @package App\Http\Controllers\Admin
 *
 * @property CommentRepository $commentRepository
 */
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
        try {
            $this->commentRepository->toggleStatus($id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('tag.index')->with('danger', 'Ошибка при измении статуса комментария!');
        }

        return redirect()->back()->with('success', 'Статус комментария успешно изменен!');
    }

    public function destroy($id)
    {
        try {
            $this->commentRepository->delete($id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->route('tag.index')->with('danger', 'Ошибка при удалении комментария!');
        }

        return redirect()->back()->with('success', 'Комментарий успешно удален!');
    }
}
