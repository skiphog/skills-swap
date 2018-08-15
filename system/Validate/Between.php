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

        if (\is_int($value)) {
            if ($value < $min || $value > $max) {
                throw new ValidateException($this->getMessage("Поле {$this->field} должно быть между {$min} и {$max}"));
            }

            return $value;
        }

        if (\is_string($value)) {
            if (($length = mb_strlen($value)) < $min || $length > $max) {
                $this->getMessage("Количество символов в поле {$this->field} должно быть между {$min} и {$max}");
            }

            return $value;
        }

        if (\is_array($value)) {
            if (($count = \count($value)) < $min || $count > $max) {
                $this->getMessage("Количество элементов в массиве {$this->field} должно быть между {$min} и {$max}");
            }

            return $value;
        }

        return $value;
    }
}
