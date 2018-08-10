<?php

use System\Routing\Router;

/**
 * @var Router $route
 */

$route->get('/', 'IndexController@index')->middleware('profiler');


$route->get('/test/{id:\d+}/{token}', 'IndexController@index');


$route->group('/auth', function (Router $r) {
    $r->post('/login', 'Auth\AuthController@login')->middleware('guest');
    $r->get('/logout', 'Auth\AuthController@logout')->middleware('auth');

    $r->get('/token/{token}', 'Auth\RegistrationController@token')->middleware('guest');
    $r->get('/repass', 'Auth\RegistrationController@repass')->middleware('guest');
    $r->post('/registration', 'Auth\RegistrationController@store')->middleware('guest');
    $r->post('/confirm', 'Auth\RegistrationController@confirm')->middleware('guest');
    $r->post('/repass', 'Auth\RegistrationController@retoken')->middleware('guest');
});
