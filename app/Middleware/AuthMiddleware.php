<?php

namespace App\Middleware;

use System\Http\Request;
use System\Middleware\Middleware;

class AuthMiddleware extends Middleware
{

    public function handle(Request $request, callable $next)
    {
        if (auth()->isGuest()) {
            return redirect('/');
        }

        return $next($request);
    }
}
