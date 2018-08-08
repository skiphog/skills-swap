<?php

namespace System;

use App\Middleware\ProfilerMiddleware;
use System\Middleware\MiddlewareResolver;
use System\Routing\Route;
use System\Routing\Router;
use System\Middleware\Pipline;

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
            /** @var Route $route */
            [$route, $attributes] = Router::load(\dirname(__DIR__) . '/app/route.php')->match();
            [$controller, $action] = $this->parseHandler(...$route->getHandler());

            $request = request()->setAttributes($attributes);
            $this->setRegistry();

            $pipline = new Pipline($controller, $action);
            $resolver = new MiddlewareResolver($route);

            foreach ($resolver->middleware() as $middleware) {
                $pipline->pipe($middleware);
            }

            echo $pipline->run($request);
        } catch (\Exception $e) {
            http_response_code(404);
            var_dump($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    /**
     * @param string $controller
     * @param string $action
     *
     * @return array
     */
    protected function parseHandler($controller, $action)
    {
        $controller = 'App\\Controllers\\' . $controller;

        if (!class_exists($controller)) {
            throw new \BadMethodCallException("Контроллера [ {$controller} ] не существует");
        }

        if (!method_exists($controller, $action)) {
            throw new \BadMethodCallException(
                'Метод { ' . $action . ' } в контроллере [ ' . static::class . ' ] не найден'
            );
        }

        return [$controller, $action];
    }

    protected function setRegistry(): void
    {
        require \dirname(__DIR__) . '/app/register.php';
    }
}
