<?php

namespace System;

/**
 * Class Bootstrap
 *
 * @package System
 */
class Bootstrap
{
    public function start(): void
    {
        try {
            [$controller, $action, $attributes] = Router::load(\dirname(__DIR__) . '/app/route.php')->match();
            $request = request()->setAttributes($attributes);
            $controller = $this->getController($controller);

            $this->setRegistry();

            $response = $controller->callAction($action, $request);

            echo $response;
        } catch (\Exception $e) {
            http_response_code(404);
            echo $e->getMessage();
        }
    }

    /**
     * @param string  $controller
     *
     * @return Controller
     */
    protected function getController($controller): Controller
    {
        $controller = 'App\\Controllers\\' . $controller;

        if (!class_exists($controller)) {
            throw new \BadMethodCallException('Контроллера ' . $controller . ' не существует');
        }

        return new $controller();
    }

    protected function setRegistry(): void
    {
        require \dirname(__DIR__) . '/app/register.php';
    }
}
