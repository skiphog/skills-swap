<?php

namespace System\Http;

use System\Exceptions\ForbiddenException;

/**
 * Class FormRequest
 *
 * @mixin Request
 * @package App\Component
 */
abstract class FormRequest
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

        // Здесь вызвать валидатор
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->request->{$name}($arguments);
    }
}
