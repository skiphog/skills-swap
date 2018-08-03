<?php

namespace App\Mail;

use App\Models\Users\User;
use App\Component\Mailer\MailInterface;

class RegistrationMail implements MailInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function from()
    {
        return 'skills-swap <registration@skills-swap.ru>';
    }

    public function subject()
    {
        return 'Подтверждение регистрации';
    }

    public function message()
    {
        return render('mail/registration', ['user' => $this->user]);
    }
}
