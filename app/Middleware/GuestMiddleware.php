<?php

namespace App\Middleware;

use System\Http\Request;
use System\Middleware\Middleware;

class GuestMiddleware extends Middleware
{
    /**
     * @param Request  $request
     * @param callable $next
     *
     * @return mixed
     */
    public function handle(Request $request, callable $next)
    {
        if (auth()->isUser()) {
            return redirect('/');
        }

        return $next($request);
    }
}
