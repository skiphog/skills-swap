<?php

use Wardex\Router\Router;

/**
 * @var Router $route
 */

$route->get('/', 'IndexController@index');
$route->get('/fuck/{id:\d+}', 'IndexController@index');

$route->group('/auth', function (Router $r) {
    $r->post('/registration', 'Auth\RegistrationController@store');
    $r->post('/login', 'Auth\AuthController@login');
});
