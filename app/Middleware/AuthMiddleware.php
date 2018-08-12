<?php

namespace App\Middleware;

use System\Http\Request;
use System\Middleware\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{

    public function handle(Request $request, callable $next)
    {
        if (auth()->isGuest()) {
            return redirect('/');
        }

        return $next($request);
    }
}
