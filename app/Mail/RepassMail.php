<?php

namespace App\Mail;

use App\Models\Users\User;
use App\Component\Mailer\MailInterface;

class RepassMail implements MailInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function from()
    {
        return 'skills-swap <repass@skills-swap.ru>';
    }

    public function subject()
    {
        return 'Восстановление доступа';
    }

    public function message()
    {
        return render('mail/repass', ['user' => $this->user]);
    }
}
