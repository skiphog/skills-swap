<?php

namespace System\Middleware;

use System\Http\Request;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, callable $next)
    {
        try {
            return $next($request);
        } catch (\Throwable $e) {
            var_dump(\get_class($e));
            var_dump($e);
            die;
        }
    }
}
