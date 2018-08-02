<?php

namespace App\Validate;

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
    }

    protected function password($value)
    {
        $this->trowIfEmpty($value, 'Пароль');
    }
}
