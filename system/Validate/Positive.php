<?php

namespace System\Validate;

use System\Exceptions\ValidateException;

class Positive extends Validator
{
    public function validate($value)
    {
        if (false === $value = filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
            throw new ValidateException($this->getMessage("Поле {$this->field} должно быть целым числом больше 0"));
        }

        return $value;
    }
}
