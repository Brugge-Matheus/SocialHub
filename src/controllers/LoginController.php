<?php

namespace src\controllers;

use \core\Controller;

class LoginController extends Controller
{
    public function signin()
    {
        $this->render('login');
    }
    public function signinAction()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if($email && $password) {

        }

        $this->redirect('/login');
    }

    public function signup()
    {
        dd('Signup');
    }
}