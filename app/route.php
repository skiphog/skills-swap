<?php

use Wardex\Router\Router;

/**
 * @var Router $route
 */

$route->get('/', 'IndexController@index');

$route->group('/auth', function (Router $r) {
    $r->get('/registration', 'Auth\RegistrationController@index');
});
