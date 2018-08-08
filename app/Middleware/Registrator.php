<?php

namespace App\Middleware;

class Registrator
{
    public static $general_middleware = [
        ProfilerMiddleware::class
    ];

    public static $middleware = [
        'auth'     => AuthMiddleware::class,
        'guest'    => GuestMiddleware::class,
        'profiler' => ProfilerMiddleware::class,
    ];
}
