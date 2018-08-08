<?php

namespace System\Routing;

use System\Exceptions\HttpException;

/**
 * Class Router
 *
 * @package Wardex\Router
 */
class Router
{
    /**
     * @var Route[]
     */
    protected $routes = [
        'GET'  => [],
        'POST' => []
    ];

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var array
     */
    protected $middleware = [];

    /**
     * @param string $path
     *
     * @return Router
     */
    public static function load(string $path)
    {
        if (!is_readable($path)) {
            throw new \RuntimeException("Файл с маршрутами [ {$path} ] не найден");
        }

        $route = new static();
        /** @noinspection PhpIncludeInspection */
        require $path;

        return $route;
    }

    /**
     * @param string $pattern
     * @param string $handler
     *
     * @return Route
     */
    public function get($pattern, $handler)
    {
        return $this->setRoute('GET', $pattern, $handler);
    }

    /**
     * @param string $pattern
     * @param string $handler
     *
     * @return Route
     */
    public function post($pattern, $handler)
    {
        return $this->setRoute('POST', $pattern, $handler);
    }

    /**
     * @param string       $prefix
     * @param callable     $callback
     * @param string|array $middleware
     */
    public function group($prefix, callable $callback, $middleware = [])
    {
        $this->prefix = trim($prefix, '/');
        $this->middleware = (array)$middleware;
        $callback($this);
        $this->prefix = null;
        $this->middleware = [];
    }

    /**
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function match()
    {
        $uri = $this->uri();

        foreach ((array)$this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if (preg_match($route->pattern(), $uri, $matches)) {
                return [$route, $matches];
            }
        }

        throw new HttpException("Роут {$_SERVER['REQUEST_METHOD']} [ {$uri} ] не зарегистрирован");
    }

    /**
     * @param string $method
     *
     * @return array
     */
    public function getRoutes($method = null)
    {
        if (null === $method) {
            return $this->routes;
        }

        return $this->routes[strtoupper($method)] ?? null;
    }

    /**
     * @param string $method
     * @param string $pattern
     * @param string $handler
     *
     * @return Route
     */
    protected function setRoute($method, $pattern, $handler)
    {
        $pattern = trim($this->prefix . '/' . ltrim($pattern, '/'), '/');

        return $this->routes[$method][] = new Route($handler, $pattern, $this->middleware);
    }

    /**
     * @return string
     */
    protected function uri()
    {
        $uri = ltrim($_SERVER['REQUEST_URI'], '/');

        return (false !== $pos = strpos($uri, '?')) ? substr($uri, 0, $pos) : $uri;
    }
}
