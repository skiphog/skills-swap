<?php

namespace System\Http;

use System\Exceptions\MultiException;
use System\Exceptions\ForbiddenException;

/**
 * Class FormRequest
 *
 * @mixin Request
 * @package App\Component
 */
abstract class FormRequest implements \IteratorAggregate
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected static $fields = [];

    /**
     * FormRequest constructor.
     */
    public function __construct()
    {
        $this->request = request();
        $this->validate();
    }

    /**
     * @return bool
     */
    public function access()
    {
        return true;
    }

    public function validate()
    {
        if (!$this->access()) {
            throw new ForbiddenException('Доступ запрещен');
        }

        $this->run();
    }

    /**
     * @throws MultiException
     */
    protected function run()
    {
        $multi = new MultiException();
        $data = $this->request->all();

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

    public function trowIfEmpty($value, $field)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("Поле {$field} обязателено к заполнению");
        }
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->request->{$name}(...$arguments);
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->request->all());
    }
}
