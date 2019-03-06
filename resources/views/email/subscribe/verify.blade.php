Для подтверждения своей почты нажмите на кнопку:

@component('mail::button', ['url' => route('subscribe.verify', ['token' => $subscriber->getToken()])])
    Подтвердить емейл
@endcomponent

С уважением,
Илья Максимов
