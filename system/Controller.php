<?php

namespace System;

use System\Http\Request;
use System\Exceptions\MultiException;
use System\Exceptions\ForbiddenException;

/**
 * Class Controller
 *
 * @package System
 */
abstract class Controller
{
    /**
     * @param string  $action
     *
     * @param Request $request
     *
     * @return mixed
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

        try {
            $response = $this->action($action, $request);
        } catch (MultiException $e) {
            if ($request->isAjax()) {
                return json(['errors' => $e], 422);
            }

            return back()
                ->withInputs($request)
                ->withSession('errors', $e->toArray());
        }

        return $response;
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

    protected function action($action, Request $request)
    {
        $method = new \ReflectionMethod($this, $action);

        $args = array_map(function (\ReflectionParameter $param) use ($request) {
            if (null === $arg = $param->getClass()) {
                return $request->{$param->getName()};
            }

            return Container::get($arg->getName());
        }, $method->getParameters());

        return $method->invokeArgs($this, $args);
    }
}
