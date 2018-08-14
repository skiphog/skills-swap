<?php

namespace System\Http;

/**
 * Class Request
 *
 * @package System\Http
 */
class Request
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

    /**
     * @var array
     */
    protected $all;

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
        return $this->getData($this->get, $params);
    }

    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function post($params = null)
    {
        return $this->getData($this->post, $params);
    }

    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function cookie($params = null)
    {
        return $this->getData($this->cookie, $params);
    }

    /**
     * @return array
     */
    public function all()
    {
        if (null !== $this->all) {
            return $this->all;
        }

        return $this->all = array_merge($this->post(), $this->get());
    }

    /**
     * @param $args
     *
     * @return string|array|null
     */
    public function input($args)
    {
        $all = $this->all();

        return $this->getData($all, $args);
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
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->all());
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
     * @param string|array $name
     * @param string|null  $value
     *
     * @return Request
     */
    public function setAttributes($name, $value = null)
    {
        $this->all = null;

        foreach (\is_array($name) ? $name : [$name => $value] as $key => $item) {
            \is_string($key) && $this->get[$key] = $item;
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
     * @param $data
     * @param $args
     *
     * @return array|string|null
     */
    protected function getData(&$data, $args)
    {
        if (null === $args) {
            return $data;
        }

        if (\is_string($args)) {
            return $data[$args] ?? null;
        }

        $result = [];

        foreach ((array)$args as $arg) {
            isset($data[$arg]) && $result[$arg] = $data[$arg];
        }

        return $result;
    }

    public function __set($name, $value)
    {
        $this->setAttributes($name, $value);
    }

    public function __get($name)
    {
        return $this->input($name);
    }

    public function __isset($name)
    {
        return $this->has($name);
    }
}
