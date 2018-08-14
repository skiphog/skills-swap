<?php

namespace System\Validate;

use System\Exceptions\ValidateException;

class Email extends Validator
{
    public function validate($value)
    {
        if (false === $value = filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new ValidateException(
                $this->getMessage("Поле {$this->field} должно быть действительным электронным адресом.")
            );
        }

        return strtolower($value);
    }
}
