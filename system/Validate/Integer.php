<?php

namespace System\Validate;

use System\Exceptions\ValidateException;

class Integer extends Validator
{
    public function validate($value)
    {
        if (false === $value = filter_var($value, FILTER_VALIDATE_INT)) {
            throw new ValidateException($this->getMessage("Поле {$this->field} должно быть целым числом"));
        }

        return $value;
    }
}
