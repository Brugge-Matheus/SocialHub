<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller {

    public function signin() {
        $flash = ''; 

        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('login', [
            'flash' => $flash
        ]);
    }

    public function signinAction() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $passwd = filter_input(INPUT_POST, 'password');

        if($email && $passwd) {
            $token = LoginHandler::verifyLogin($email, $passwd);

            if($token) {
                $_SESSION['token'] = $token;
                $this->redirect('/');

            } else {
                $_SESSION['flash'] = 'E-mail e/ou senha não conferem';
                $this->redirect('/login');
            }

        } else {
            $_SESSION['flash'] = 'Digite os campos de e-mail e/ou senha.';
            $this->redirect('/login');
        }
    }

    public function signup() {
        echo "Cadastro";
    }

    public function signupAction() {
        echo 'Cadastro recebido';
    }

}