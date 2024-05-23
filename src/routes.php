<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');


$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@signinAction');


$router->get('/register', 'LoginController@signup');
$router->post('/register', 'LoginController@signupAction');

$router->get('search', '');
$router->get('profile', '');
$router->get('friends', '');
$router->get('photos', '');
$router->get('config', '');
$router->get('exit', '');