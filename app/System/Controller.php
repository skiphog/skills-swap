<?php

namespace App\System;

use Wardex\Http\Request;
use App\Exceptions\ForbiddenException;

/**
 * Class Controller
 *
 * @package System
 */
abstract class Controller
{
    /**
     * @param string  $action
     * @param Request $request
     *
     * @return mixed
     * @throws ForbiddenException
     */
    public function callAction($action, Request $request)
    {
        if (!method_exists($this, $action)) {
            throw new \BadMethodCallException('Метод ' . $action . ' в контроллере ' . static::class . ' не найден');
        }

        if (!$this->access()) {
            throw new ForbiddenException('Доступ запрещен');
        }

        $this->before();

        return $this->$action($request);
    }

    /**
     * Access
     *
     * @return bool
     */
    protected function access(): bool
    {
        return true;
    }

    protected function before(): void
    {
    }
}
