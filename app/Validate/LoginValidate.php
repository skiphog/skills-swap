<?php

namespace App\Validate;

use App\Models\Users\User;
use App\Component\Validator\Validator;

class LoginValidate extends Validator
{
    protected static $fields = [
        'email',
        'password'
    ];

    protected function email($value)
    {
        $this->trowIfEmpty($value, 'email');

        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Проверьте корректность Email');
        }

        if (User::existsEmail($value)) {
            throw new \InvalidArgumentException('Такой email уже существует в базе');
        }
    }

    protected function password($value)
    {
        $this->trowIfEmpty($value, 'Пароль');

        if (mb_strlen($value) < 3) {
            throw new \InvalidArgumentException('Пароль должен быть не меньше трех символов');
        }
    }
}
