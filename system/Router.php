<?php

namespace System;

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
    public $routes = [
        'GET'  => [],
        'POST' => []
    ];

    /**
     * @var string
     */
    public $prefix;

    /**
     * @param string $path
     *
     * @return Router
     */
    public static function load(string $path): Router
    {
        if (!is_readable($path)) {
            throw new \InvalidArgumentException('Файл с маршрутами не найден');
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
    public function get($pattern, $handler): void
    {
        $this->setRoute('GET', $pattern, $handler);
    }

    /**
     * @param string $pattern
     * @param string $handler
     */
    public function post($pattern, $handler): void
    {
        $this->setRoute('POST', $pattern, $handler);
    }

    /**
     * @param string   $prefix
     * @param callable $callback
     */
    public function group($prefix, callable $callback): void
    {
        $this->prefix = $prefix;
        $callback($this);
        $this->prefix = null;
    }

    /**
     * @todo:: Кэш роутов
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function match(): array
    {
        $uri = $this->getUri();

        foreach ((array)$this->routes[$_SERVER['REQUEST_METHOD']] as $pattern => $handler) {
            if (preg_match('#^' . $this->getPattern($pattern) . '$#', $uri, $matches)) {
                return array_merge(explode('@', $handler), [$matches]);
            }
        }

        throw new \InvalidArgumentException("Роут {$_SERVER['REQUEST_METHOD']} [ {$uri}] не зарегистрирован");
    }

    /**
     * @param string $method
     * @param string $pattern
     * @param string $handler
     */
    protected function setRoute($method, $pattern, $handler): void
    {
        $pattern = trim(trim($this->prefix, '/') . '/' . trim($pattern, '/'), '/');

        $this->routes[$method][$pattern] = $handler;
    }

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
    protected function getPattern($pattern): string
    {
        return preg_replace_callback('#{([^\}:]+):?([^\}]*?)\}#', function ($matches) {
            return '(?P<' . $matches[1] . '>' . ($matches[2] ?: '.+') . ')';
        }, $pattern);
    }
}
