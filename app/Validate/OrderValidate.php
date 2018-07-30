<?php

namespace App\Validate;

use App\Component\Validator\Validator;

class OrderValidate extends Validator
{
    protected static $fields = [
        'name',
        'date',
        'time',
        'guests',
        'phone',
        'rules',
        'email'
    ];

    protected function name($value)
    {
        return !empty($value);
    }

    protected function date($value)
    {
        return !empty($value);
    }

    protected function time($value)
    {
        return !empty($value);
    }

    protected function guests($value)
    {
        return (int)$value > 0;
    }

    protected function phone($value)
    {
        return preg_match('#^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$#', $value);
    }

    protected function rules($value)
    {
        return !empty($value);
    }

    protected function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
