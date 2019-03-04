<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\Subscribe\StoreRequest;
use App\Mail\SubscribeEmail;
use App\Repositories\SubscribeRepository;
use App\Http\Controllers\Controller;

class SubscribeController extends Controller
{
    private $subscribeRepository;

    public function __construct(SubscribeRepository $subscribeRepository)
    {
        $this->subscribeRepository = $subscribeRepository;
    }

    public function store(StoreRequest $request)
    {
        $subscriber = $this->subscribeRepository->add($request->toArray());
        \Mail::to($subscriber->getEmail())->send(new SubscribeEmail($subscriber));
        return redirect()->back()->with('status', 'Сейчас вам на почту придет сообщение! Вам необходимо подтвердить вашу почту!');
    }

    public function verify($token)
    {
        $subscriber = $this->subscribeRepository->findOneBy(['token' => $token]);
        if ($subscriber) {
            $subscriber->verify();
            \EntityManager::persist($subscriber);
            \EntityManager::flush();
            return redirect('/')->with('status', 'Ваша почта успешно подтверждена!');
        }

        return redirect('/')->with('danger', 'Ваша почта уже верифицированна!');
    }
}
