<?php

return [
    \System\Config::class       => function () {
        return new \System\Config();
    },
    \System\DataBase::class     => function () {
        return new \System\DataBase();
    },
    \App\Component\Auth::class  => function () {
        return (new \App\Component\Auth())->getAuthUser();
    },
    \System\Http\Request::class => function () {
        return new \System\Http\Request();
    },
    'cache'                     => function () {
        $config = config('cache');

        return new \System\Cache\Cache(new $config['driver']($config['path']));
    }
];
