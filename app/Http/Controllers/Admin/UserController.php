<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 *
 * @property UserRepository $userRepository
 */
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

    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', 'Ошибка при удалении пользователя!');
        }

        return redirect()->back()->with('success', 'Пользователь успешно удален!');
    }
}
