<?php

namespace System\Middleware;

use System\Http\Request;

interface MiddlewareInterface
{
    public function handle(Request $request, callable $next);
}
