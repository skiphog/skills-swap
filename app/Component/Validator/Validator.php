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
                method_exists($this, $field) && $this->$field($data[$field] ?? null);
            } catch (\Exception $e) {
                $multi->add($e);
            }
        }

        if ($multi->hasErrors()) {
            throw $multi;
        }
    }

    protected function trowIfEmpty($data, $field)
    {
        if (empty($data)) {
            throw new \InvalidArgumentException("Поле {$field} обязателено к заполнению");
        }
    }
}
