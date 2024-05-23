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

        $this->render('signin', [
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
        $flash = ''; 

        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('signup', [
            'flash' => $flash
        ]);
    }

    public function signupAction() {
        $name = filter_input(INPUT_POST, 'name');
        $birthdate = filter_input(INPUT_POST, 'birthdate');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $passwd = filter_input(INPUT_POST, 'password');

        if($name && $birthdate && $email && $passwd) {
            $birthdate = explode('/', $birthdate);

            if(count($birthdate) !== 3) {
                $_SESSION['flash'] = 'Data de nascimento inválida';
                $this->redirect('/register');
            }

            $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
            if(strtotime($birthdate) === false) {
                $_SESSION['flash'] = 'Data de nascimento inválida';
                $this->redirect('/register');
            }

            if(LoginHandler::emailExists($email) === false) {
                $token = LoginHandler::addUser($name, $email, $passwd, $birthdate);
                $_SESSION['token'] = $token;
                $this->redirect('/');

            } else {
                $_SESSION['flash'] = 'E-mail ja cadastrado';
                $this->redirect('/register');
            }

        } else {
            $_SESSION['flash'] = 'Preencha os campos corretamente';
            $this->redirect('/register');
        }
    }

}