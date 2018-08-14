<?php

namespace System\Validate;

use System\Exceptions\ValidateException;

class Required extends Validator
{
    public function process($value)
    {
        return $this->validate($value);
    }

    public function validate($value)
    {
        if (null === $value || '' === $value) {
            throw new ValidateException($this->getMessage("Поле {$this->field} обязательно для заполнения"));
        }

        return $value;
    }
}
