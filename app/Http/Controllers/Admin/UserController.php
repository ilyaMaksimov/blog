<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->findAll();
        return view('admin.user.index', compact('users'));
    }

    public function destroy()
    {
        return redirect()->back()->with('success', 'Пользователь успешно удален!');
    }
}
