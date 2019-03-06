<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\Subscribe\StoreRequest;
use App\Mail\SubscribeEmail;
use App\Repositories\SubscribeRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class SubscribeController
 * @package App\Http\Controllers\Frontend
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

    public function store(StoreRequest $request)
    {
        try {
            $subscriber = $this->subscribeRepository->add($request->toArray());

            \Mail::to($subscriber->getEmail())->send(new SubscribeEmail($subscriber));

            \EntityManager::flush();

        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', 'Ошибка при добавлении подписчика!');
        }

        return redirect()->back()
            ->with('success', 'Сейчас вам на почту придет сообщение! Вам необходимо подтвердить вашу почту!');
    }

    public function verify($token)
    {
        $subscriber = $this->subscribeRepository->findOneBy(['token' => $token]);

        if (!$subscriber) {
            throw new NotFoundHttpException('Такого подписчика не сущетсвует!');
        }

        $subscriber->verify();
        \EntityManager::persist($subscriber);
        \EntityManager::flush();
        return redirect('/')->with('success', 'Ваша почта успешно подтверждена!');
    }
}
