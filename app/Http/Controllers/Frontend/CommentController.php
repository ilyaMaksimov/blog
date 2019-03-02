<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(Request $request)
    {
        //dd($request->toArray());
        $this->commentRepository->add($request->toArray());
        return redirect()->back()->with('status', 'Ваш комментарий будет скоро добавлен!');
    }

    public function destroy($id)
    {
       // dd($id);
        $this->commentRepository->delete($id);
        return redirect()->back()->with('status', 'Ваш комментарий успешно удален!');
    }
}
