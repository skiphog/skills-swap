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
        if (!$this->access()) {
            throw new ForbiddenException('Доступ запрещен');
        }

        $this->before();

        try {
            $response = $this->action($action, $request);
        } catch (MultiException $e) {
            if ($request->ajax()) {
                return json(['errors' => $e], 422);
            }

            if ($request->type() === 'POST') {
                return back()
                    ->withInputs($request)
                    ->withSession('errors', $e->toArray());
            }
            //@todo:: что-то придумать!
            var_dump($e->toArray());
            die;
        }

        return $response;
    }

    /**
     * Access
     *
     * @return bool
     */
    protected function access()
    {
        return true;
    }

    protected function before()
    {
    }

    protected function action($action, Request $request)
    {
        //@todo обернуть в трай кетч// если такого метода нет. ошибка 500
        $method = new \ReflectionMethod($this, $action);

        $args = array_map(function (\ReflectionParameter $param) use ($request) {
            if (null === $arg = $param->getClass()) {
                return $request->get($param->getName());
            }

            return Container::get($arg->getName());
        }, $method->getParameters());

        return $method->invokeArgs($this, $args);
    }
}
