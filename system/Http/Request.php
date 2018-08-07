<?php

namespace System\Http;

/**
 * Class Request
 *
 * @package System\Http
 */
class Request implements \IteratorAggregate
{
    /**
     * @var array
     */
    protected $get;

    /**
     * @var array
     */
    protected $post;

    /**
     * @var array
     */
    protected $files;

    /**
     * @var array
     */
    protected $cookie;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->cookie = $_COOKIE;
    }

    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function get($params = null)
    {
        return $this->getRequest('get', $params);
    }

    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function post($params = null)
    {
        return $this->getRequest('post', $params);
    }

    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function cookie($params = null)
    {
        return $this->getRequest('cookie', $params);
    }

    /**
     * @return array
     */
    public function all()
    {
        return array_merge($this->post(), $this->get());
    }

    /**
     * @param $args
     *
     * @return string|array|null
     */
    public function input($args)
    {
        $all = $this->all();

        return $this->getAll($all, $args);
    }

    /**
     * @param array|string $args
     *
     * @return array
     */
    public function only($args)
    {
        return array_intersect_key($this->all(), array_flip((array)$args));
    }

    /**
     * @param array|string $args
     *
     * @return array
     */
    public function except($args)
    {
        $args = (array)$args;

        return array_filter($this->all(), function ($key) use ($args) {
            return !\in_array($key, $args, true);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * @param string $filename
     *
     * @return bool
     */
    public function hasFile($filename)
    {
        return !empty($this->files[$filename]) && UPLOAD_ERR_NO_FILE !== $this->files[$filename]['error'];
    }

    /**
     * @param string $filename
     *
     * @return array|null
     */
    public function file($filename)
    {
        return $this->files[$filename] ?? null;
    }

    /**
     * @param array $params
     *
     * @return Request
     */
    public function setAttributes(array $params)
    {
        foreach ($params as $key => $value) {
            \is_string($key) && $this->get[$key] = $value;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function uri()
    {
        $uri = ltrim($_SERVER['REQUEST_URI'], '/');

        return (false !== $pos = strpos($uri, '?')) ? substr($uri, 0, $pos) : $uri;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return bool
     */
    public function ajax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * @return mixed [ip address or false]
     */
    public function clientIp()
    {
        return filter_var(
            $_SERVER['REMOTE_ADDR'],
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );
    }

    /**
     * @return int
     */
    public function clientIp2long(): int
    {
        return (int)sprintf('%u', ip2long($this->clientIp()));
    }

    /**
     * @param $param
     * @param $args
     *
     * @return array|string|null
     */
    protected function getRequest($param, $args)
    {
        $data = array_map('trim', $this->{$param});

        return $this->getAll($data, $args);
    }

    /**
     * @param $data
     * @param $args
     *
     * @return array|string|null
     */
    protected function getAll(&$data, $args)
    {
        if (null === $args) {
            return $data;
        }

        if (!\is_array($args)) {
            return $data[$args] ?? null;
        }

        $result = [];

        foreach ((array)$args as $arg) {
            isset($data[$arg]) && $result[$arg] = $data[$arg];
        }

        return $result;
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }
}
