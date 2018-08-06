<?php

namespace App\Validate;

use App\Component\Validator\Validator;

class RepassValidate extends Validator
{
    protected static $fields = [
        'email',
    ];

    protected function email($value)
    {
        $this->trowIfEmpty($value, 'email');

        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Проверьте корректность Email');
        }
    }
}
