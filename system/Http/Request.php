<?php

namespace System\Http;

/**
 * Class Request
 *
 * @property integer $id
 *
 * @package Wardex\Http
 */
class Request
{
    /**
     * @var array $get
     */
    protected $get;

    /**
     * @var array $post
     */
    protected $post;

    /**
     * @var array $files
     */
    protected $files;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
    }

    /**
     * @param mixed $params
     * @param mixed $options
     *
     * @return mixed
     */
    public function get($params = null, $options = null)
    {
        return $this->getRequest($this->get, $params, $options);
    }

    /**
     * @param mixed $params
     * @param mixed $options
     *
     * @return mixed
     */
    public function post($params = null, $options = null)
    {
        return $this->getRequest($this->post, $params, $options);
    }

    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function getInteger($params = null)
    {
        return $this->get($params, 'sanitizeInt');
    }

    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function postInteger($params = null)
    {
        return $this->post($params, 'sanitizeInt');
    }

    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function getString($params = null)
    {
        return $this->get($params, 'sanitizeString');
    }

    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function postString($params = null)
    {
        return $this->post($params, 'sanitizeString');
    }

    /**
     * @param mixed $params
     * @param mixed $options
     *
     * @return array
     */
    public function getValues($params = null, $options = null): array
    {
        return (null !== $result = $this->get($params, $options)) ? array_values((array)$result) : [null];
    }

    /**
     * @param mixed $params
     * @param mixed $options
     *
     * @return array
     */
    public function postValues($params = null, $options = null): array
    {
        return (null !== $result = $this->post($params, $options)) ? array_values((array)$result) : [null];
    }

    /**
     * @param mixed $params
     *
     * @return array
     */
    public function getValuesInteger($params = null): array
    {
        return $this->getValues($params, 'sanitizeInt');
    }

    /**
     * @param mixed $params
     *
     * @return array
     */
    public function getValuesString($params = null): array
    {
        return $this->getValues($params, 'sanitizeString');
    }

    /**
     * @param mixed $params
     *
     * @return array
     */
    public function postValuesInteger($params = null): array
    {
        return $this->postValues($params, 'sanitizeInt');
    }

    /**
     * @param mixed $params
     *
     * @return array
     */
    public function postValuesString($params = null): array
    {
        return $this->postValues($params, 'sanitizeString');
    }

    /**
     * @param string $filename
     *
     * @return bool
     */
    public function hasFile(string $filename): bool
    {
        return !empty($this->files[$filename]) && UPLOAD_ERR_NO_FILE !== $this->files[$filename]['error'];
    }

    /**
     * @param string $filename
     *
     * @return array|null
     */
    public function file(string $filename): ?array
    {
        return $this->files[$filename] ?? null;
    }

    /**
     * @param array $params
     *
     * @return Request
     */
    public function setAttributes(array $params): Request
    {
        foreach ($params as $key => $value) {
            \is_string($key) && $this->get[$key] = $value;
        }

        return $this;
    }

    /**
     * @param array $params
     *
     * @return Request
     */
    public function setPostAttribute(array $params): Request
    {
        foreach ($params as $key => $value) {
            $this->post[$key] = $value;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function uri(): string
    {
        return ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return bool
     */
    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * @return mixed [ip address or false]
     */
    public function getClientIp()
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
    public function getClientIp2long(): int
    {
        return (int)sprintf('%u', ip2long($this->getClientIp()));
    }

    /**
     * @param array $data
     * @param mixed $params
     * @param mixed $options
     *
     * @return mixed
     */
    protected function getRequest(array &$data, $params, $options)
    {
        $result = $this->getAllRequest($data, $params);

        if (null !== $options) {
            $result = $this->$options($result);
        }

        return $result;
    }

    /**
     * @param array $data
     * @param mixed $params
     *
     * @return mixed
     */
    protected function getAllRequest(array &$data, $params)
    {
        if (null === $params) {
            return $data;
        }

        $result = [];

        foreach ((array)$params as $param) {
            $result[$param] = $data[$param] ?? null;
        }

        return \count($result) === 1 ? array_shift($result) : $result;
    }

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    protected function sanitizeInt($data)
    {
        return $this->sanitize($data, function ($value) {
            return abs((int)$value);
        });
    }

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    protected function sanitizeString($data)
    {
        return $this->sanitize($data, function ($value) {
            return trim(strip_tags($value));
        });
    }


    /**
     * @param mixed    $data
     * @param callable $callback
     *
     * @return mixed
     */
    protected function sanitize($data, callable $callback)
    {
        if (\is_array($data)) {
            return array_map(function ($value) use ($callback) {
                return $this->sanitize($value, $callback);
            }, $data);
        }

        return $callback($data);
    }

    public function __get($name)
    {
        return $this->get($name) ?: $this->post($name);
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
    }

    public function __isset($name)
    {
        // TODO: Implement __isset() method.
    }
}
