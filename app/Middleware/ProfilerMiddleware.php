<?php

namespace App\Middleware;

use System\Http\Request;
use System\Http\Response;
use System\Middleware\Middleware;

class ProfilerMiddleware extends Middleware
{

    public function handle(Request $request, callable $next)
    {
        /** @var Response $response */
        $response = $next($request);

        return $response
            ->withHeaders(['Profiler-Skip-Hog' => convertBite(memory_get_usage())]);
    }
}
