<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\Profile\UpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        return view('frontend.profile.index', compact('user'));
    }

    public function store(UpdateRequest $request)
    {

        $this->userRepository->update($request, Auth::id());
        return redirect()->back()->with('status', 'Профиль успешно обновлен');
    }
}
