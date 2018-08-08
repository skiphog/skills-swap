<?php

namespace System\Http;

/**
 * Class Response
 *
 * @package Wardex\Http
 */
class Response
{
    protected $data;

    /**
     * @param mixed $data
     *
     * @return Response
     */
    public function setData($data): Response
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param string $url
     * @param int    $code
     *
     * @return Response
     */
    public function redirect($url, $code = 302): Response
    {
        $this->setHeader('Location: ' . $url, $code);

        return $this;
    }

    /**
     * @return Response
     */
    public function back(): Response
    {
        $url = !empty($_SERVER['HTTP_REFERER']) && false !== filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL)
            ? $_SERVER['HTTP_REFERER'] : '/';

        return $this->redirect($url, 302);
    }

    /**
     * @param mixed $data
     * @param int   $code
     *
     * @return Response
     */
    public function json($data, $code = 200): Response
    {
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException(json_last_error_msg());
        }

        $this->setHeader('Content-Type: application/json;charset=utf-8', $code);

        return $this->setData($json);
    }

    /**
     * Записывает данные в сессию
     *
     * @param $name
     * @param $value
     *
     * @return Response
     */
    public function withSession($name, $value = null): Response
    {
        $data = \is_array($name) ? $name : [$name => $value];

        foreach ($data as $key => $item) {
            $_SESSION[$key] = $item;
        }

        return $this;
    }

    /**
     * @param array  $data [name => value]
     * @param bool   $secure
     * @param int    $expire
     * @param string $path
     * @param string $domain
     *
     * @return Response
     */
    public function withCookie(array $data, $secure = false, $expire = 0x7FFFFFFF, $path = '/', $domain = ''): Response
    {
        foreach ($data as $key => $value) {
            setcookie($key, $value, $expire, $path, $domain, $secure, true);
        }

        return $this;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function withInputs(Request $request): Response
    {
        return $this->withSession($request->post());
    }

    /**
     * @param array $header
     * @param int   $code
     * @param bool  $replace
     *
     * @return Response
     */
    public function withHeaders(array $header, $code = null, $replace = false): Response
    {
        foreach ($header as $key => $value) {
            $this->setHeader($key . ': ' . $value, $code, $replace);
        }

        return $this;
    }

    /**
     * Устанавливает заголовок
     *
     * @param string $header
     * @param int    $code
     * @param bool   $replace
     */
    protected function setHeader($header, $code = null, $replace = true): void
    {
        header($header, $replace, $code);
    }

    /**
     * Устанавливает заголовок и прекращает работу приложения
     *
     * @param int   $code
     * @param mixed $data
     *
     * @codeCoverageIgnore
     */
    public function abort(int $code, $data = null): void
    {
        http_response_code($code);
        echo $data;

        die;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->data;
    }
}
