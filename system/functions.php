<?php

/**
 * Получить объект из контейнера
 *
 * @param string $name
 *
 * @return mixed
 */
function app($name)
{
    return \System\Container::get($name);
}

/**
 * @param string $key
 *
 * @return mixed
 */
function config($key)
{
    return app(\System\Config::class)->get($key);
}

/**
 * @return \System\DataBase
 */
function db()
{
    return app(\System\DataBase::class);
}

/**
 * @return \App\Models\Users\AuthUser
 */
function auth()
{
    return app(\App\Component\Auth::class);
}

/**
 * @return \System\Http\Request
 */
function request()
{
    return app(\System\Http\Request::class);
}

/**
 * @return \System\Cache\Cache
 */
function cache()
{
    return app('cache');
}

/**
 * @param string $url
 * @param int    $code
 *
 * @return \System\Http\Response
 */
function redirect($url, $code = 302)
{
    return (new \System\Http\Response())->redirect($url, $code);
}

/**
 * @return \System\Http\Response
 */
function back()
{
    return (new \System\Http\Response())->back();
}

/**
 * @param mixed $data
 * @param int   $code
 *
 * @return \System\Http\Response
 */
function json($data, $code = 200)
{
    return (new \System\Http\Response())->json($data, $code);
}

/**
 * @param int  $code
 * @param null $data
 */
function abort($code = 404, $data = null)
{
    (new \System\Http\Response())->abort($code, $data);
}

/** @noinspection PhpDocMissingThrowsInspection */
/**
 * @param string $name
 * @param array  $params
 *
 * @return string
 */
function render($name, array $params = [])
{
    /** @noinspection PhpUnhandledExceptionInspection */
    return (new \System\View(config('view')['path']))->render($name, $params);
}

/**
 * @param string $name
 * @param array  $params
 *
 * @return \System\Http\Response
 */
function view($name, array $params = [])
{
    return (new \System\Http\Response())->setData(render($name, $params));
}

function old($name, $default = null)
{
    if (empty($_SESSION[$name])) {
        return $default;
    }

    $data = $_SESSION[$name];
    unset($_SESSION[$name]);

    return $data;
}


/**
 * Экранирует теги
 *
 * @param $string string
 *
 * @return string string
 */
function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE);
}

/**
 * @todo Доделать
 *
 * @param $url
 *
 * @return string
 */
function url($url)
{
    return $url;
}

/**
 * @param $string [FooBarBaz]
 *
 * @return string [fooBarBaz]
 */
function camel($string)
{
    return lcfirst(studly($string));
}

/**
 * @param $string [foo_bar_baz]
 *
 * @return string [FooBarBaz]
 */
function studly($string)
{
    return implode('', array_map('ucfirst', explode('_', $string)));
}

/**
 * @param mixed    $value
 * @param callable $callback
 *
 * @return mixed
 */
function tap($value, callable $callback)
{
    $callback($value);

    return $value;
}

/**
 * @param string $text
 * @param int    $sub
 * @param string $end
 *
 * @return string
 */
function subText($text, $sub, $end = '')
{
    if (mb_strlen($text) > $sub) {
        $text = mb_substr($text, 0, (int)$sub);
        $text = mb_substr($text, 0, mb_strrpos($text, ' '));
        $text .= $end;
    }

    return $text;
}

function convertBite($bytes)
{
    $prefix = ['B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB'];

    $class = min((int)log($bytes, 1024), count($prefix) - 1);

    return sprintf('%1.2f %s', $bytes / 1024 ** $class, $prefix[$class]);
}

/**
 * @param $string
 *
 * @return string
 */
function compress($string)
{
    $replace = [
        '#>[^\S ]+#s'                                                     => '>',
        '#[^\S ]+<#s'                                                     => '<',
        '#([\t ])+#s'                                                     => ' ',
        '#^([\t ])+#m'                                                    => '',
        '#([\t ])+$#m'                                                    => '',
        '#//[a-zA-Z0-9 ]+$#m'                                             => '',
        '#[\r\n]+([\t ]?[\r\n]+)+#s'                                      => "\n",
        '#>[\r\n\t ]+<#s'                                                 => '><',
        '#}[\r\n\t ]+#s'                                                  => '}',
        '#}[\r\n\t ]+,[\r\n\t ]+#s'                                       => '},',
        '#\)[\r\n\t ]?{[\r\n\t ]+#s'                                      => '){',
        '#,[\r\n\t ]?{[\r\n\t ]+#s'                                       => ',{',
        '#\),[\r\n\t ]+#s'                                                => '),',
        '#([\r\n\t ])?([a-zA-Z0-9]+)="([a-zA-Z0-9_/\\-]+)"([\r\n\t ])?#s' => '$1$2=$3$4'
    ];

    return preg_replace(array_keys($replace), array_values($replace), $string);
}

/**
 * @param int    $number
 * @param string $words [1|2|0] - [год|года|лет]
 *
 * @return string
 */
function plural($number, $words)
{
    $tmp = explode('|', $words);

    if (count($tmp) < 3) {
        return '';
    }

    /** @noinspection NestedTernaryOperatorInspection */
    return $tmp[(($number % 10 === 1) && ($number % 100 !== 11)) ? 0 :
        ((($number % 10 >= 2) && ($number % 10 <= 4) && (($number % 100 < 10) || ($number % 100 >= 20))) ? 1 : 2)];
}
