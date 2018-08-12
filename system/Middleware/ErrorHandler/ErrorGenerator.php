<?php

namespace System\Middleware\ErrorHandler;

use System\Http\Request;

class ErrorGenerator
{
    /**
     * @var \Throwable
     */
    private $e;
    /**
     * @var Request
     */
    private $request;

    /**
     * @var bool
     */
    private $debug;

    public function __construct(\Throwable $e, Request $request, $debug)
    {
        $this->e = $e;
        $this->request = $request;
        $this->debug = $debug;
    }

    public function generate()
    {

    }
}
