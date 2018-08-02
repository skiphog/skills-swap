<?php

namespace App\Component\Validator;

abstract class Validator
{
    protected static $fields = [];

    /**
     * @param array $data
     *
     * @throws MultiException
     */
    public function validate(array $data)
    {
        $multi = new MultiException();

        foreach (static::$fields as $field) {
            try {
                $method = camel($field);
                method_exists($this, $method) && $this->$method($data[$field] ?? null);
            } catch (\Exception $e) {
                $multi->add($field, $e);
            }
        }

        if ($multi->hasErrors()) {
            throw $multi;
        }
    }

    protected function trowIfEmpty($value, $field)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("Поле {$field} обязателено к заполнению");
        }
    }

}
