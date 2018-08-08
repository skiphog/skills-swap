<?php

namespace System\Routing;

class Route
{
    /**
     * @var string
     */
    protected $handler;

    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var $string
     */
    protected $name;

    /**
     * @var array;
     */
    protected $middleware = [];

    public function __construct($handler, $pattern, array $middleware = [])
    {
        $this->handler = $handler;
        $this->pattern = $pattern;
        $this->middleware = $middleware;
    }

    /**
     * @param string $name
     */
    public function name($name)
    {
        $this->name = $name;
    }

    /**
     * @param string|array $middleware
     *
     * @return $this
     */
    public function middleware($middleware)
    {
        foreach ((array)$middleware as $item) {
            $this->middleware[] = $item;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function pattern()
    {
        $pattern = preg_replace_callback('#{([^\}:]+):?([^\}]*?)\}#', function ($matches) {
            return '(?P<' . $matches[1] . '>' . ($matches[2] ?: '.+') . ')';
        }, $this->pattern);

        return '#^' . $pattern . '$#';
    }

    /**
     * @return array
     */
    public function getHandler()
    {
        return explode('@', $this->handler);
    }

    /**
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }
}
