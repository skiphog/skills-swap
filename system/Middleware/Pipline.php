<?php

namespace System\Middleware;

class Pipline
{
    /**
     * @var \SplQueue
     */
    protected $queue;

    /**
     * @var string \System\Controller
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action;


    public function __construct($controller, $action)
    {
        $this->queue = new \SplQueue();
        $this->controller = $controller;
        $this->action = $action;
    }

    public function pipe($middleware)
    {
        $this->queue->enqueue($middleware);
    }

    public function run($request)
    {
        if ($this->queue->isEmpty()) {
            /** @var \System\Controller $controller */
            $controller = new $this->controller;

            return $controller->callAction($this->action, $request);
        }

        /** @var Middleware $middleware */
        $middleware = $this->queue->dequeue();
        $middleware = new $middleware;

        return $middleware->handle($request, function ($request) {
            return $this->run($request);
        });
    }
}
