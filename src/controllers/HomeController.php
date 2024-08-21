<?php

namespace src\controllers;

use \core\Controller;
use \src\helpers\LoginValidate;

class HomeController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = LoginValidate::checkLogin();

        if (!$this->loggedUser) {
            $this->redirect('/login');
        }
    }

    public function index()
    {
        $this->render('home', ['user' => $this->loggedUser ?? '']);
    }
}