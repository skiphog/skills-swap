<?php

use Skiphog\Cache;
use Skiphog\Container;

Container::set('cache', function () {
    $config = config('cache');

    return new Cache(new $config['driver']($config['path']));
});
