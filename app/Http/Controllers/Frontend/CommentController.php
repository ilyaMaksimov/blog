<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CommentController
 * @package App\Http\Controllers\Frontend\
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

    public function store(Request $request)
    {
        try {
            $this->commentRepository->add($request->toArray());
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->back()->with('status', 'Ошибка при добавлении комментария!');
        }

        return redirect()->back()->with('status', 'Ваш комментарий будет скоро добавлен!');
    }

    public function destroy($id)
    {
        try {
            $this->commentRepository->delete($id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', 'Ошибка при удалении ткомментария!');
        }

        return redirect()->back()->with('status', 'Ваш комментарий успешно удален!');
    }
}
