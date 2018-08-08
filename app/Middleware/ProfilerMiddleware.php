<?php

namespace App\Middleware;

use System\Http\Request;
use System\Http\Response;
use System\Middleware\Middleware;

class ProfilerMiddleware extends Middleware
{

    public function handle(Request $request, callable $next)
    {
        $start = microtime(true);
        /** @var Response $response */
        $response = $next($request);
        $stop = microtime(true);

        return $response
            ->withHeaders(['Profiler-Skip-Hog' => $stop - $start]);
    }
}
