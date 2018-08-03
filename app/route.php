<?php

use Wardex\Router\Router;

/**
 * @var Router $route
 */

$route->get('/', 'IndexController@index');

$route->group('/auth', function (Router $r) {
    $r->get('/token/{token}', 'Auth\RegistrationController@token');
    $r->post('/registration', 'Auth\RegistrationController@store');
    $r->post('/login', 'Auth\AuthController@login');
});
