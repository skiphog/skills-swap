<?php

namespace System;

use System\Exceptions\HttpException;

/**
 * Class Router
 *
 * @package Wardex\Router
 */
class Router
{
    /**
     * @var array $routes
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
     */
    public function get($pattern, $handler)
    {
        $this->setRoute('GET', $pattern, $handler);
    }

    /**
     * @param string $pattern
     * @param string $handler
     */
    public function post($pattern, $handler)
    {
        $this->setRoute('POST', $pattern, $handler);
    }

    /**
     * @param string   $prefix
     * @param callable $callback
     */
    public function group($prefix, callable $callback)
    {
        $this->prefix = trim($prefix, '/');
        $callback($this);
        $this->prefix = null;
    }

    /**
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function match()
    {
        $uri = $this->getUri();

        foreach ((array)$this->routes[$_SERVER['REQUEST_METHOD']] as $pattern => $handler) {
            if (preg_match('#^' . $this->getPattern($pattern) . '$#', $uri, $matches)) {
                return array_merge(explode('@', $handler), [$matches]);
            }
        }

        throw new HttpException("Роут {$_SERVER['REQUEST_METHOD']} [ {$uri} ] не зарегистрирован");
    }

    /**
     * @param string $method
     * @param string $pattern
     * @param string $handler
     */
    protected function setRoute($method, $pattern, $handler)
    {
        $pattern = trim($this->prefix . '/' . ltrim($pattern, '/'), '/');

        $this->routes[$method][$pattern] = $handler;
    }

    /**
     * @return string
     */
    protected function getUri()
    {
        $uri = ltrim($_SERVER['REQUEST_URI'], '/');

        return (false !== $pos = strpos($uri, '?')) ? substr($uri, 0, $pos) : $uri;
    }

    /**
     * @param string $pattern
     *
     * @return string
     */
    protected function getPattern($pattern)
    {
        return preg_replace_callback('#{([^\}:]+):?([^\}]*?)\}#', function ($matches) {
            return '(?P<' . $matches[1] . '>' . ($matches[2] ?: '.+') . ')';
        }, $pattern);
    }
}
