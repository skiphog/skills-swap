<?php

namespace System;

use System\Middleware\Pipline;
use App\Middleware\Registrator;
use System\Middleware\RouteMiddleware;
use System\Middleware\ErrorHandlerMiddleware;

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
