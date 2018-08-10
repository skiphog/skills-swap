<?php

namespace System\Middleware;

use System\Http\Request;
use System\Routing\Router;
use App\Middleware\Registrator;

class RouteMiddleware implements MiddlewareInterface
{

    public function handle(Request $request, callable $next)
    {
        /** @var \System\Routing\Route $route */
        [$route, $attributes] = Router::load(\dirname(__DIR__, 2) . '/app/route.php')->match();
        $request->setAttributes($attributes);


        $pipline = new Pipline();

        foreach ($route->getMiddleware() as $name) {
            if (!array_key_exists($name, Registrator::$middleware)) {
                throw new \RuntimeException("Middleware [ {$name} ] не существует.");
            }
            $pipline->pipe(Registrator::$middleware[$name]);
        }

        $pipline->pipe(function () use ($route) {
            return new ControllerMiddleware(... $route->getHandler());
        });

        return $pipline->run($request);
    }
}
