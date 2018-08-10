<?php

namespace System\Middleware;

class Pipline
{
    /**
     * @var \SplQueue
     */
    protected $queue;


    public function __construct()
    {
        $this->queue = new \SplQueue();
    }

    public function pipe($middleware)
    {
        $this->queue->enqueue($middleware);
    }

    public function run($request)
    {
        /** @var MiddlewareInterface $middleware */
        $middleware = $this->queue->dequeue();
        $middleware = $middleware instanceof \Closure ? $middleware() : new $middleware;

        return $middleware->handle($request, function ($request) {
            return $this->run($request);
        });
    }
}
