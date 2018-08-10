<?php

namespace System;

use App\Middleware\Registrator;
use System\Middleware\ErrorHandlerMiddleware;
use System\Middleware\RouteMiddleware;
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
        $this->setRegistry();
        $pipline = new Pipline();
        $pipline->pipe(ErrorHandlerMiddleware::class);
        foreach (Registrator::$general_middleware as $middleware) {
            $pipline->pipe($middleware);
        }
        $pipline->pipe(RouteMiddleware::class);

        echo $pipline->run(request());
    }

    protected function setRegistry(): void
    {
        require \dirname(__DIR__) . '/app/register.php';
    }
}
