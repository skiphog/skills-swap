<?php

namespace System\Middleware;

use System\Http\Request;

abstract class Middleware
{
    abstract public function handle(Request $request, callable $next);
}
