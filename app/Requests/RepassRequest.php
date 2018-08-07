<?php

namespace App\Requests;

use System\Http\FormRequest;

class RepassRequest extends FormRequest
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
