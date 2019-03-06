<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\Profile\UpdateRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ProfileController
 * @property UserRepository $userRepository
 */
class ProfileController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $user = $this->userRepository->find(Auth::id());
        if (!$user) {
            throw new NotFoundHttpException('Такого пользователя не существует!');
        }

        return view('frontend.profile.index', compact('user'));
    }

    public function store(UpdateRequest $request)
    {
        try {
            $this->userRepository->update($request, Auth::id());
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', 'Ошибка при при обновлении профиля!');
        }

        return redirect()->back()->with('status', 'Профиль успешно обновлен');
    }
}
