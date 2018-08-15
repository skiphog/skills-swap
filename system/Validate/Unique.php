<?php

namespace System\Validate;

use System\Exceptions\RuleException;
use System\Exceptions\ValidateException;

class Unique extends Validator
{
    public function validate($value)
    {
        if (null === $this->params || !\is_string($this->params)) {
            throw new RuleException("Передан неверный параметр в unique [{$this->params}]");
        }

        $sql = "select exists(select * from {$this->params} where {$this->field} = :item)";

        $sth = db()->prepare($sql);
        $sth->execute(['item' => $value]);

        if ((bool)$sth->fetchColumn()) {
            throw new ValidateException($this->getMessage("{$this->field} уже существует"));
        }
    }
}
