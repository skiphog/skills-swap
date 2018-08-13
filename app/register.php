<?php

use System\Container;
use System\Cache\Cache;

Container::set('auth', function () {
    return (new \App\Component\Auth())->getAuthUser();
});

Container::set('cache', function () {
    $config = config('cache');

    return new Cache(new $config['driver']($config['path']));
});

//@todo add all dependenses
