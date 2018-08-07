<?php

namespace App\Requests;

use System\Validator\Validator;

class RepassRequest extends Validator
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
