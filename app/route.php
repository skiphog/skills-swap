<?php

use Wardex\Router\Router;

/**
 * @var Router $route
 */

$route->get('/', 'IndexController@index');

$route->group('/auth', function (Router $r) {
    $r->post('/login', 'Auth\AuthController@login');
    $r->get('/logout', 'Auth\AuthController@logout');

    $r->get('/token/{token}', 'Auth\RegistrationController@token');
    $r->get('/repass', 'Auth\RegistrationController@repass');
    $r->post('/registration', 'Auth\RegistrationController@store');
    $r->post('/confirm', 'Auth\RegistrationController@confirm');
    $r->post('/repass', 'Auth\RegistrationController@repass');
});
