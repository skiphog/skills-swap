<?php

namespace App\Validate;

use App\Component\Validator\Validator;

class ConfirmValidate extends Validator
{
    protected static $fields = [
        'password',
        'token',
    ];

    public function password($value)
    {
        $this->trowIfEmpty($value, 'Пароль');

        if (mb_strlen($value) < 3) {
            throw new \InvalidArgumentException('Пароль должен быть не меньше трех символов');
        }
    }

    public function token($value)
    {
        $this->trowIfEmpty($value, 'Токен');
    }
}
