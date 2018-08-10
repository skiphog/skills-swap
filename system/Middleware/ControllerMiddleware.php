<?php

namespace System\Middleware;

use System\Http\Request;

class ControllerMiddleware implements MiddlewareInterface
{
    /**
     * @var \System\Controller
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    public function __construct($controller, $action)
    {
        $controller = 'App\\Controllers\\' . $controller;
        $this->controller = new $controller;
        $this->action = $action;
    }

    public function handle(Request $request, callable $next)
    {
        return $this->controller->callAction($this->action, $request);
    }
}
