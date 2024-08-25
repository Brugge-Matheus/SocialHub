<?php

namespace src\controllers;

use \core\Controller;
use src\helpers\LoginHelper;

class LoginController extends Controller
{
    public function signin()
    {
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        $this->render('login', ['flash' => $flash ?? '']);
    }
    public function signinAction()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if ($email && $password) {
            $token = LoginHelper::verifyLogin($email, $password);

            if ($token) {
                $_SESSION['token'] = $token;
                $this->redirect('/');
            }

            $_SESSION['flash'] = "Credenciais erradas ou inválidas";
            $this->redirect('/login');
        }

        $_SESSION['flash'] = "Favor preencher todos os campos";
        $this->redirect('/login');
    }

    public function signup()
    {
        var_dump('Signup');
    }
}
