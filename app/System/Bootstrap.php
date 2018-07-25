<?php

namespace App\System;

use App\System\Cache\Cache;
use Skiphog\Router;
use Skiphog\Container;

/**
 * Class Bootstrap
 *
 * @package System
 */
class Bootstrap
{
    public function start(): void
    {
        try {
            $request = request();
            [$controller, $action, $attributes] = Router::load(__DIR__ . '/../route.php')->match();
            $request->setAttributes($attributes);

            $controller = $this->getController($controller);

            $this->setRegistry();

            $response = $controller->callAction($action, $request);

            echo $response;
        } catch (\Exception $e) {
            http_response_code(404);
            echo $e->getMessage();
        }
    }

    /**
     * @param $controller
     *
     * @return Controller
     */
    protected function getController($controller): Controller
    {
        $controller = 'App\\Controllers\\' . $controller;

        if (!class_exists($controller)) {
            throw new \BadMethodCallException('Контроллера ' . $controller . ' не существует');
        }

        return new $controller;
    }

    protected function setRegistry(): void
    {
        Container::set('cache', function () {
            $class = config('cache_driver');

            return new Cache(new $class);
        });

        Container::set('content', function () {
            $languages = config('languages');

            $file = isset($_COOKIE['lang']) && array_key_exists($_COOKIE['lang'], $languages) ?
                $languages[$_COOKIE['lang']] :
                $languages['ru'];

            /** @noinspection PhpIncludeInspection */
            return require $file;
        });
    }
}
