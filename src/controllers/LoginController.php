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
        } else {

            $_SESSION['flash'] = "Favor preencher todos os campos";
            $this->redirect('/login');
        }
    }

    public function signup()
    {
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        $this->render('register', ['flash' => $flash ?? '']);
    }

    public function signupAction()
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $birthdate = filter_input(INPUT_POST, 'birthdate');

        if (!$name or !$email or !$password or !$birthdate) {
            $_SESSION['flash'] = "Favor preencher todos os campos";
            $this->redirect('/register');
        }

        if (count(explode('/', $birthdate)) !== 3) {
            $_SESSION['flash'] = "Favor digitar uma data de nascimento válida";
            $this->redirect('/register');
        }

        $birthdate = date('Y/m/d', strtotime(str_replace('/', '-', $birthdate)));

        if (!LoginHelper::emailExists($email)) {
            $token = LoginHelper::addUser($name, $email, $password, $birthdate);
            $_SESSION['token'] = $token;
            $this->redirect('/');
        } else {
            $_SESSION['flash'] = "E-mail já cadastrado!";
            $this->redirect('/register');
        }
    }
}