<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SubscribeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SubscribeController
 * @package App\Http\Controllers\Admin
 *
 * @property SubscribeRepository $subscribeRepository
 */
class SubscribeController extends Controller
{
    private $subscribeRepository;

    public function __construct(SubscribeRepository $subscribeRepository)
    {
        $this->subscribeRepository = $subscribeRepository;
    }

    public function index()
    {
        $subscribers = $this->subscribeRepository->findAll();
        return view('admin.subscribe.index', compact('subscribers'));
    }

    public function destroy($id)
    {
        try {
            $this->subscribeRepository->delete($id);
            \EntityManager::flush();
        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', 'Ошибка при удалении подписчика!');
        }

        return redirect()->back()->with('success', 'Подписчик успешно удален!');
    }
}
