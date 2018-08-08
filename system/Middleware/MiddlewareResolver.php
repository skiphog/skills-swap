<?php

namespace System\Middleware;

use System\Routing\Route;
use App\Middleware\Registrator;

class MiddlewareResolver
{
    /**
     * @var Route
     */
    protected $rout;

    public function __construct(Route $rout)
    {
        $this->rout = $rout;
    }

    public function middleware()
    {
        $middleware = [];

        foreach ($this->rout->getMiddleware() as $name) {
            if (!array_key_exists($name, Registrator::$middleware)) {
                throw new \RuntimeException("Middleware [ {$name} ] не существует.");
            }
            $middleware[] = Registrator::$middleware[$name];
        }

        return array_merge(Registrator::$general_middleware, $middleware);
    }
}
