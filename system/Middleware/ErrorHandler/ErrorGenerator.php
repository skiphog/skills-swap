<?php

namespace System\Middleware\ErrorHandler;

use System\Http\Request;

class ErrorGenerator
{
    /**
     * @var \Throwable
     */
    protected $e;
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var bool
     */
    protected $debug = false;

    public function __construct(\Throwable $e, Request $request, $debug = false)
    {
        $this->e = $e;
        $this->request = $request;
        $this->debug = $debug;
    }

    public function generate()
    {
        if ($this->debug) {
            return $this->generateDebug();
        }

        return $this->generateProduction();
    }

    protected function generateDebug()
    {
        $code = $this->getStatusCode();

        if ($this->request->ajax()) {
            return json([
                'except'  => \get_class($this->e),
                'message' => $this->e->getMessage(),
                'line'    => $this->e->getLine(),
                'file'    => $this->e->getFile(),
                'code'    => $code
            ], $code);
        }

        http_response_code($code);
        var_dump($code, $this->e);
        die;
    }

    protected function generateProduction()
    {
        $code = $this->getStatusCode();

        if ($this->request->ajax()) {
            return json([
                'message' => 'Something went wrong',
                'code'    => $code
            ], $code);
        }

        return $this->generateTemplate($code);
    }

    protected function generateTemplate($code)
    {
        //@todo Сделать шаблоны или контроллеры для вывода ошибок
        http_response_code($code);

        return $code;
    }

    /**
     * @return int
     */
    protected function getStatusCode()
    {
        $code = $this->e->getCode();

        if ($code > 399 && $code < 600) {
            return $code;
        }

        return 500;
    }
}
