<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SubscribeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function destroy()
    {
        return redirect()->back()->with('success', 'Подписчик успешно удален!');
    }
}
