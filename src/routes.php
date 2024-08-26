<?php

use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->get('/register', 'LoginController@signup');

$router->get('/search{s}', 'HomeController@searchAction');

$router->post('/login', 'LoginController@signinAction');
$router->post('/register', 'LoginController@signupAction');

$router->post('/post/new', 'PostController@newPost');
