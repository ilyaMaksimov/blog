<?php

namespace App\Mail;

use App\Entities\Subscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SubscribeEmail
 * @package App\Mail
 *
 * @property Subscribe  $subscriber
 */
class SubscribeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;

    public function __construct(Subscribe $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function build()
    {
        return $this
            ->subject('Верификация с блога Максимова Ильи')
            ->markdown('email.subscribe.verify');
    }
}
