<?php

namespace App\Validate;

use App\Component\Validator\Validator;
use App\Models\Users\User;

class RegistrationValidate extends Validator
{
    protected static $fields = [
        'first_name',
        'email',
        'password',
        'confirm'
    ];

    public function firstName($value)
    {
        if (mb_strlen($value) > 100) {
            throw new \InvalidArgumentException('Слишком длинное имя');
        }
    }

    public function email($value)
    {
        $this->trowIfEmpty($value, 'email');

        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Проверьте корректность Email');
        }

        if (User::existsEmail($value)) {
            throw new \InvalidArgumentException('Такой email уже существует');
        }
    }

    public function password($value)
    {
        $this->trowIfEmpty($value, 'Пароль');

        if (mb_strlen($value) < 3) {
            throw new \InvalidArgumentException('Пароль должен быть не меньше трех символов');
        }
    }

    public function confirm($value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Поставьте галочку');
        }
    }
}
