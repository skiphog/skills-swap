<?php

namespace System\Middleware;

use System\Http\Request;
use System\Middleware\ErrorHandler\ErrorGenerator;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, callable $next)
    {
        try {
            return $next($request);
        } catch (\Throwable $e) {
            return (new ErrorGenerator($e, $request, true))->generate();
        }
    }
}
