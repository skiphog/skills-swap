<?php

return [
    'config'  => function () {
        return new \System\Config();
    },
    'db'      => function () {
        return new \System\DataBase();
    },
    'auth'    => function () {
        return (new \App\Component\Auth())->getAuthUser();
    },
    'request' => function () {
        return new \System\Http\Request();
    },
    'cache'   => function () {
        $config = config('cache');

        return new \System\Cache\Cache(new $config['driver']($config['path']));
    }
];
