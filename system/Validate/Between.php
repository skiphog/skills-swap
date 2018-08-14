<?php

namespace System\Validate;

use System\Exceptions\RuleException;
use System\Exceptions\ValidateException;

class Between extends Validator
{
    public function validate($value)
    {
        if (null === $this->params ||
            2 !== \count($params = explode(',', $this->params)) ||
            !\is_numeric($params[0]) ||
            !\is_numeric($params[1]) ||
            ($min = (int)$params[0]) > ($max = (int)$params[1])
        ) {
            throw new RuleException("Передан неверный параметр в between [{$this->params}]");
        }

        if (\is_int($value) && ($value < $min || $value > $max)) {
            throw new ValidateException($this->getMessage("Поле {$this->field} должно быть между {$min} и {$max}"));
        }

        if (\is_string($value) && (($length = mb_strlen($value)) < $min || $length > $max)) {
            throw new ValidateException(
                $this->getMessage("Количество символов в поле {$this->field} должно быть между {$min} и {$max}")
            );
        }

        if (\is_array($value) && (($count = \count($value)) < $min || $count > $max)) {
            throw new ValidateException(
                $this->getMessage("Количество элементов в массиве {$this->field} должно быть между {$min} и {$max}")
            );
        }

        return $value;
    }
}
