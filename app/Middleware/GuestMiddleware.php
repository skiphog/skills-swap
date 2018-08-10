<?php

namespace App\Middleware;

use System\Http\Request;
use System\Middleware\MiddlewareInterface;

class GuestMiddleware implements MiddlewareInterface
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
