<?php

namespace App\Component\Validator;

class ValidateException extends \Exception
{
    protected $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
        parent::__construct('', 0, null);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
