<?php

namespace App\Component\Validator;

abstract class Validator
{
    protected static $fields = [];

    /**
     * @param array $data
     *
     * @throws ValidateException
     */
    public function validate(array $data)
    {
        if ($errors = $this->getErrors($data)) {
            throw new ValidateException($errors);
        }
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function getErrors(array $data)
    {
        $errors = [];
        foreach (static::$fields as $field) {
            if (!array_key_exists($field, $data)) {
                $errors[] = $field;
                continue;
            }

            if (!$this->$field($data[$field])) {
                $errors[] = $field;
            }
        }

        return $errors;
    }
}
