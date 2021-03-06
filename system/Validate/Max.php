<?php

namespace System\Validate;

use System\Exceptions\RuleException;
use System\Exceptions\ValidateException;

class Max extends Validator
{
    public function validate($value)
    {
        if (null === $this->params || !\is_numeric($this->params)) {
            throw new RuleException("Передан неверный параметр в min [{$this->params}]");
        }

        $param = (int)$this->params;

        if (\is_string($value)) {
            if (\mb_strlen($value) > $param) {
                throw new ValidateException(
                    $this->getMessage("Количество символов в поле {$this->field} должно быть не более {$param}")
                );
            }

            return $value;
        }

        if (\is_int($value)) {
            if ($value > $param) {
                throw new ValidateException($this->getMessage("Поле {$this->field} должно быть не более {$param}"));
            }

            return $value;
        }

        if (\is_array($value)) {
            if (\count($value) > $param) {
                throw new ValidateException(
                    $this->getMessage("Количество элементов в массиве {$this->field} должно быть не более {$param}")
                );
            }

            return $value;
        }

        return $value;
    }
}
