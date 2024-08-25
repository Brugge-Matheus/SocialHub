<?php

use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->get('/register', 'LoginController@signup');

$router->post('/login', 'LoginController@signinAction');
